<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\AuthorRepository;
use App\Repository\EditorRepository;
use App\Repository\SerieRepository;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/serie')]
final class SerieController extends AbstractController
{
    /**
     * Méthode permettant d'afficher la liste des séries
     * @param SerieRepository $serieRepository
     * @return Response
     */
    #[Route(name: 'app_serie_index', methods: ['GET'])]
    public function index(SerieRepository $serieRepository): Response
    {
        $series = $serieRepository->getAllInfos();

        return $this->render('serie/index.html.twig', [
            'series' => $series,
        ]);
    }

    /**
     * Méthode permettant de créer une nouvelle série
     * @param Request $request
     * @param SerieRepository $serieRepository
     * @return Response
     */
    #[Route('/new', name: 'app_serie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SerieRepository $serieRepository): Response
    {
        $serie = new Serie();
        // Création du formulaire avec option is_edit à false pour afficher le champ imagePath
        $form = $this->createForm(SerieType::class, $serie, ['is_edit' => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion de l'image uploadée
            $imageFile = $form->get('imagePath')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // On génère un nom de fichier unique
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                // On déplace le fichier dans le dossier public/images
                try {
                    $imageFile->move(
                        $this->getParameter('covers_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Une erreur est survenue lors de l\'upload de l\'image');
                }

                // On set le nom de l'image dans l'entité
                $serie->setImagePath($newFilename);
            }

            $serieRepository->save($serie, true);

            return $this->redirectToRoute('app_serie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('serie/new.html.twig', [
            'serie' => $serie,
            'form' => $form,
        ]);
    }

    /**
     * Méthode permettant d'afficher une série
     * @param Serie $serie
     * @param AuthorRepository $authorRepository
     * @param EditorRepository $editorRepository
     * @param TypeRepository $typeRepository
     * @return Response
     */
    #[Route('/{id}', name: 'app_serie_show', methods: ['GET'])]
    public function show(Serie $serie, AuthorRepository $authorRepository, EditorRepository $editorRepository, TypeRepository $typeRepository): Response
    {
        $authors = $authorRepository->getAuthorsBySerie($serie->getId());

        $editors = $editorRepository->getEditorsBySerie($serie->getId());

        $types = $typeRepository->getTypesBySerie($serie->getId());

        return $this->render('serie/show.html.twig', [
            'serie' => $serie,
            'authors' => $authors,
            'editors' => $editors,
            'types' => $types,
        ]);
    }

    /**
     * Méthode permettant de modifier une série
     * @param Request $request
     * @param Serie $serie
     * @param SerieRepository $serieRepository
     * @return Response
     */
    #[Route('/{id}/edit', name: 'app_serie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Serie $serie, SerieRepository $serieRepository): Response
    {
        // Création du formulaire avec option is_edit à true pour permettre le non changement de l'image
        $form = $this->createForm(SerieType::class, $serie, ['is_edit' => true]);
        $form->get('currentImage')->setData($serie->getImagePath()); // Préremplit le champ caché avec l'image actuelle

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion de l'image uploadée
            $imageFile = $form->get('imagePath')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // On génère un nom de fichier unique
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {
                    // On déplace le fichier dans le dossier configuré
                    $imageFile->move(
                        $this->getParameter('covers_images_directory'),
                        $newFilename
                    );
                    $serie->setImagePath($newFilename); // Met à jour le chemin de l'image
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Une erreur est survenue lors de l\'upload de l\'image');
                }
            } else {
                // Conserver l'image actuelle si aucune nouvelle image n'est uploadée
                $serie->setImagePath($form->get('currentImage')->getData());
            }

            // Enregistrement de l'entité
            $serieRepository->save($serie, true);

            return $this->redirectToRoute('app_serie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('serie/edit.html.twig', [
            'serie' => $serie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Méthode permettant de supprimer une série
     * @param Request $request
     * @param Serie $serie
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/{id}', name: 'app_serie_delete', methods: ['POST'])]
    public function delete(Request $request, Serie $serie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$serie->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($serie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_serie_index', [], Response::HTTP_SEE_OTHER);
    }
}
