<?php

namespace App\Controller;

use App\Form\Data\ContentTypeModifiedContentsData;
use Ibexa\Contracts\Core\Repository\SearchService;
use Ibexa\Core\Pagination\Pagerfanta\ContentSearchAdapter;
use Ibexa\Core\QueryType\QueryTypeRegistry;
use Ibexa\AdminUi\Form\SubmitHandler;
use Ibexa\Contracts\AdminUi\Controller\Controller;
use Pagerfanta\Pagerfanta;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\ContentTypeModifiedContentsType;

class CustomPageController extends Controller
{
    public QueryTypeRegistry $queryTypeRegistry;

    protected SearchService $searchService;

    protected SubmitHandler $submitHandler;

    public function __construct(
        QueryTypeRegistry $queryTypeRegistry,
        SearchService $searchService,
        SubmitHandler $submitHandler
    ) {
        $this->queryTypeRegistry = $queryTypeRegistry;
        $this->searchService = $searchService;
        $this->submitHandler = $submitHandler;
    }

    public function view(Request $request): Response
    {
        $form = $this->createForm(
            ContentTypeModifiedContentsType::class,
            new ContentTypeModifiedContentsData(),
            [
            'method' => Request::METHOD_GET
            ]
        );

        $form->handleRequest($request);
        if($form->isSubmitted()) {
            return $this->submitHandler->handle(
                $form,
                function (ContentTypeModifiedContentsData $data) use ($form) {
                    return $this->handleSubmittedForm($form, $data);
                }
            );
        }

        return $this->render('@ibexadesign/custom_page.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function handleSubmittedForm(FormInterface $form, ContentTypeModifiedContentsData $data): Response
    {
        $queryType = $this->queryTypeRegistry->getQueryType('ContentTypeModifiedContents');

        $query = $queryType->getQuery([
            'identifier' => $data->getContentType()->identifier,
            'modified' => $data->getDateFrom()->getTimestamp(),
        ]);

        $pagerfanta = new Pagerfanta(
            new ContentSearchAdapter($query, $this->searchService)
        );

        $pagerfanta->setMaxPerPage(3);
        $page = $data->getPage();
        $pagerfanta->setCurrentPage(min($page, $pagerfanta->getNbPages()));

        $results = [];
        foreach ($pagerfanta as $content) {
            $results[] = $content;
        }

        return $this->render('@ibexadesign/custom_page.html.twig', [
            'form' => $form->createView(),
            'total_count' => $pagerfanta->getNbResults(),
            'content_type_name' => $data->getContentType()->getName(),
            'results' => $results,
            'pagerfanta' => $pagerfanta,
        ]);
    }
}