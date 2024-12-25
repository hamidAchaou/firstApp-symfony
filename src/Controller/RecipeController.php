<?php

namespace App\Controller;

use App\Entity\Recip;
use App\Form\RecipeType;
use App\Repository\RecipRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    #[Route('/recipe', name: 'app_recipes_index')]
    public function index(RecipRepository $recipRepository): Response
    {
        $recipes = $recipRepository->findAll();
        // dd($recipes);
        return $this->render('pages/recipe/index.html.twig', ['recipes' => $recipes]);
    }

    #[Route('/recipe/{slug}-{id}', name: 'recipe_show', requirements: ['id' => '\d+', 'slug' => '[a-z0-9-]+'])]
    public function show(string $slug, int $id, RecipRepository $recipRepository): Response
    {
        $recipe = $recipRepository->find($id);

        if (!$recipe || $recipe->getSlug() !== $slug) {
            throw $this->createNotFoundException('Recipe not found.');
        }

        return $this->render('pages/recipe/show.html.twig', [
            'recipe' => $recipe,
            'ingredients' => $recipe->getIngredients(),
            'instructions' => $recipe->getInstructions(),
        ]);
    }


    #[Route('/recipe/{id}/edit', name: 'recipe_edit')]
    public function edit(Recip $recipe, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'La recette a bien été modifiée');
            return $this->redirectToRoute('app_recipes_index');
        }

        return $this->render('pages/recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/recipe/create", name: "recipe_create")]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $recipe = new Recip(); // Initialize the new recipe if it's not injected
    
        // Create the form
        $form = $this->createForm(RecipeType::class, $recipe);
    
        // Handle the form submission
        $form->handleRequest($request);
    
        // If the form is submitted and valid, save the recipe
        if ($form->isSubmitted() && $form->isValid()) {
            // Save the recipe using the injected EntityManagerInterface
            $em->persist($recipe);
            $em->flush();
    
            // Redirect after successful creation
            return $this->redirectToRoute('app_recipes_index'); // Adjust with the route name to list recipes
        }
    
        // Render the form to the template
        return $this->render('pages/recipe/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}
