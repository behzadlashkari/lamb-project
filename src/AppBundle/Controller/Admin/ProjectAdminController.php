<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Project;
use AppBundle\Form\ProjectFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class ProjectAdminController extends Controller
{
    /**
     * @Route("/projects", name="admin_project_list")
     */
    public function adminProjectList()
    {
        $projects = $this->getDoctrine()
            ->getRepository('AppBundle:Project')
            ->findAll();

        return $this->render('admin/project/list.html.twig', array(
            'projects' => $projects
        ));
    }

    /**
     * @Route("/projects/new", name="admin_project_new")
     */
    public function newProject(Request $request)
    {
        $form = $this->createForm(ProjectFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();
            dump($form->getData());die;
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash('success', 'Project successfully created');
            return $this->redirectToRoute('admin_project_list');

        }

        return $this->render('admin/project/new.html.twig', [
            'projectForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/projects/{id}/edit", name="admin_project_edit")
     */
    public function editProject(Request $request, Project $project)
    {
        $form = $this->createForm(ProjectFormType::class, $project);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash('success', 'Project successfully edited');
            return $this->redirectToRoute('admin_project_list');

        }

        return $this->render('admin/project/edit.html.twig', [
            'projectForm' => $form->createView()
        ]);
    }
}