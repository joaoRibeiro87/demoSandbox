<?php

namespace App\Tab\Dashboard;

use Ibexa\Contracts\Core\Repository\SearchService;
use Ibexa\Contracts\Core\SiteAccess\ConfigResolverInterface;
use Ibexa\Contracts\AdminUi\Tab\AbstractTab;
use Ibexa\Contracts\AdminUi\Tab\OrderedTabInterface;
use Ibexa\Contracts\Core\Repository\Values\Content\Query\Criterion;
use Ibexa\Contracts\Core\Repository\Values\Content\Query\SortClause;
use Ibexa\Contracts\Core\Repository\Values\Content\Query;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

class CustomTab extends AbstractTab implements OrderedTabInterface
{
    protected SearchService $searchService;

    private ConfigResolverInterface $configResolver;

    public function __construct(
        Environment $twig,
        TranslatorInterface $translator,
        SearchService $searchService,
        ConfigResolverInterface $configResolver
    ) {
        parent::__construct($twig, $translator);

        $this->searchService = $searchService;
        $this->configResolver = $configResolver;
    }

    public function getIdentifier(): string
    {
        return 'customtab';
    }

    public function getName(): string
    {
        return $this->translator->trans('dashboard.customtab', [], 'dashboard');
    }

    public function getOrder(): int
    {
        return 300;
    }

    public function renderView(array $parameters): string
    {
        $contentTypeIdentifiers = $this->configResolver->getParameter('custom_tab_block.content_types');
        $limit = $this->configResolver->getParameter('custom_tab_block.limit');

        $query = new Query([
            'filter' => new Criterion\ContentTypeIdentifier($contentTypeIdentifiers),
            'sortClauses' => [new SortClause\DateModified(Query::SORT_DESC)],
            'limit' => $limit
        ]);

        return $this->twig->render('@ibexadesign/dashboard/tab/custom_tab.html.twig', [
            'data' => $this->searchService->findContentInfo($query)
        ]);

    }
}