<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\CertificationRepository;
use App\Repository\LastProjectRepository;
use App\Repository\ProjectRepository;
use App\Repository\QualityRepository;
use App\Repository\SocialMediaRepository;
use App\Repository\TechnologyRepository;
use App\Repository\TextRepository;
use App\Service\ImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    private $projectFilter = 'project';
    private $logoFilter = 'logo';
    private $iconeFilter = 'icone';

    #[Route('/techs', name: 'get_technology', methods: 'get')]
    public function getTechnologies(TechnologyRepository $technologyRepository, ImageService $imageService): Response
    {
        $data = [];
        foreach ($technologyRepository->findAll() as $tech) {
            $imageUrl = null;
            if ($tech->getImage()) {
                $imageUrl = $imageService->getImageUrl($tech->getImage(), $this->logoFilter);

            }
            $data[] = [
                "name" => $tech->getName(),
                "image" => $imageUrl
            ];
        }
        return $this->json($data);
    }

    #[Route('/texts', name: 'get_texts', methods: 'get')]
    public function getTextes(TextRepository $repository): Response
    {
        $texts = $repository->findAll();
        if (count($texts) == 0) {
            return $this->json(
                [
                    'homePage' => " ",
                    'about' => " "
                ]
            );
        }
        $text = $texts[0];
        return $this->json(
            [
                'homePage' => $text->getHomePageDescription(),
                'about' => $text->getAboutDescription()
            ]
        );
    }

    #[Route('/certifs', name: 'get_certificatinons')]
    public function getCertifications(CertificationRepository $repository): Response
    {
        $data = [];
        foreach ($repository->findAll() as $datum) {
            $data[] = [
                "name" => $datum->getTitle(),
                "description" => $datum->getDescription()
            ];
        }
        return $this->json($data);
    }

    #[Route('/lastProject', name: 'get_last_project', methods: 'get')]
    public function getLastProject(LastProjectRepository $repository): Response
    {
        $lasts = $repository->findAll();
        if (count($lasts) == 0) {
            return $this->json(
                [
                    'name' => " ",
                    'description' => " ",
                    'objectifs' => " ",
                    'technology' => " ",
                ]
            );
        }
        $last = $lasts[0];
        return $this->json(
            [
                'name' => $last->getName(),
                'description' => $last->getDescription(),
                'objectifs' => $last->getObjectifs(),
                'technology' => $last->getTechnology(),
            ]
        );
    }

    #[Route('/projects', name: 'get_projects', methods: 'get')]
    public function getProjects(ProjectRepository $repository, ImageService $imageService): Response
    {
        $data = [];
        foreach ($repository->findAll() as $datum) {
            if ($datum->isVisible()){
                $imageUrl = null;
                if ($datum->getImage()) {
                    $imageUrl = $imageService->getImageUrl($datum->getImage(), $this->projectFilter);

                }

                $data[] = [
                    "id" => $datum->getId(),
                    "name" => $datum->getName(),
                    "description" => $datum->getDescription(),
                    "githubLink" => $datum->getGithubLink(),
                    "link" => $datum->getLink(),
                    "image" => $imageUrl,
                    "step1" => $datum->getStep1(),
                    "step2" => $datum->getStep2(),
                    "step3" => $datum->getStep3(),
                ];
            }


        }
        return $this->json($data);
    }

    #[Route('/project/{id}', name: 'get_project', methods: 'get')]
    public function getProject(ProjectRepository $repository, ImageService $imageService, Project $project): Response
    {

        $imageUrl = null;
        if ($project->getImage()) {
            $imageUrl = $imageService->getImageUrl($project->getImage(), $this->projectFilter);

        }

        $data = [
            "id" => $project->getId(),
            "name" => $project->getName(),
            "isVisible" => $project->isVisible(),
            "description" => $project->getDescription(),
            "githubLink" => $project->getGithubLink(),
            "link" => $project->getLink(),
            "image" => $imageUrl,
            "step1" => $project->getStep1(),
            "step2" => $project->getStep2(),
            "step3" => $project->getStep3(),
        ];

        return $this->json($data);
    }

    #[Route('/qualities', name: 'get_qualities', methods: 'get')]
    public function getQualities(QualityRepository $repository): Response
    {
        $data = [];
        foreach ($repository->findAll() as $datum) {
            $data[] = [
                "name" => $datum->getName(),
                "description" => $datum->getDescription()
            ];
        }
        return $this->json($data);
    }

    #[Route('/medias', name: 'get_medias', methods: 'get')]
    public function getMedias(SocialMediaRepository $repository, ImageService $imageService): Response
    {
        $data = [];
        foreach ($repository->findAll() as $datum) {
            $imageUrl = null;
            if ($datum->getImage()) {
                $imageUrl = $imageService->getImageUrl($datum->getImage(), $this->iconeFilter);

            }
            $data[] = [
                "link" => $datum->getLink(),
                "alt" => $datum->getAlt(),
                "image" => $imageUrl,
            ];
        }
        return $this->json($data);
    }


}
