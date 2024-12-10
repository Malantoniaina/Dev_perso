<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientsRepository;
use App\Entity\Clients;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;

class ClientsController extends AbstractController
{   

    // Lister tous les clients
    #[Route('/clients', name: 'app_clients')]
    public function index(ClientsRepository $clientsRepository): Response
    {   
        $clients = $clientsRepository->findAll();
        return $this->render('clients/listClients.html.twig', [
            'controller_name' => 'ClientsController',
            'clients' => $clients
        ]);
    }

    // Ajouter client
    #[Route('/client/add', name: 'app_client_add')]
    public function addClient(Request $request, EntityManagerInterface $entityManager): Response
    {       
        $client = new Clients();

        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            // Persister le client
            $entityManager->persist($client);
            $entityManager->flush(); 

            // Message de succès et redirection
            $this->addFlash('success', 'Client ajouté avec succès !');
            return $this->redirectToRoute('app_clients');
        }


        return $this->render('clients/addClient.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Modifier client
    #[Route('/client/update/{id}', name: 'app_client_update')]
    public function updateClient(
        int $id,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        // Récupérer le produit à modifier
        $client = $entityManager->getRepository(Clients::class)->find($id);

        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Pas besoin de persist, car Doctrine suit déjà l'entité
            $entityManager->flush();

            $this->addFlash('success', 'Client modifié avec succès !');
            return $this->redirectToRoute('app_clients');
        }

        return $this->render('clients/addClient.html.twig', [
            'form' => $form->createView(),
            'client' => $client,
            'isEdit' => true
        ]);
    }

    // Supprimer un client
    #[Route('/client/delete/{id}', name: 'app_client_delete')]
    public function deleteClient(int $id, EntityManagerInterface $entityManager): Response
    {
        // Récupérer le client à supprimer
        $client = $entityManager->getRepository(Clients::class)->find($id);

        // Supprimer le client
        $entityManager->remove($client);
        $entityManager->flush();

        // Ajouter un message de succès
        $this->addFlash('success', 'Client supprimé avec succès !');

        // Redirection vers la liste des clients
        return $this->redirectToRoute('app_clients');
    }


}
