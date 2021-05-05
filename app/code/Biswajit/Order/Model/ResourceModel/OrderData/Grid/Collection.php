<?php

namespace Biswajit\Order\Model\ResourceModel\OrderData\Grid;

use Magento\Framework\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Magento\Framework\Api\SearchCriteriaInterface;
use Biswajit\Order\Model\ResourceModel\OrderData;
use Biswajit\Order\Model\ResourceModel\OrderData\Collection as GridCollection;

class Collection extends GridCollection implements SearchResultInterface
{
    protected $aggregations;

    protected function _construct()
    {
        $this->_init(Document::class, OrderData::class);
    }


    protected function _initSelect()
    {
        parent::_initSelect();
    }

    public function setItems(array $items = null)
    {
        return $this;
    }

    public function getSearchCriteria()
    {
        return null;
    }

    public function getAggregations()
    {
        return $this->aggregations;
    }

    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    public function getTotalCount()
    {
        return $this->getSize();
    }

    public function setTotalCount($totalCount)
    {
        return $this;
    }
}
