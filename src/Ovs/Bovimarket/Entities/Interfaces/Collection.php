<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 16/08/2016
 * Time: 15:53
 */

namespace Ovs\Bovimarket\Entities\Interfaces;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ExpressionBuilder;
use Doctrine\Common\Collections\Selectable;
use JMS\Serializer\SerializerBuilder;

class Collection extends ArrayCollection implements Selectable
{

    protected $class;

    public function __construct(array $elements,$class)
    {
        $this->class = $class;
        $serializer = SerializerBuilder::create()->build();
        $datas = array();
        foreach ($elements as $element){
            if($element instanceof \stdClass) {
                $datas[$element->id] = $serializer->deserialize(json_encode($element), $class, "json");
            }else{
                $datas[$element->getId()] = $element;
            }
        }
        parent::__construct($datas);
    }

    protected function createFrom(array $elements)
    {
        return new static($elements,$this->class);
    }


    public function find($id)
    {
        return $this->get($id);
    }

    public function findAll()
    {
        return $this->toArray();
    }

    public function findBy($criterias)
    {
        return $this->search($criterias);
    }

    public function findOneBy($criterias)
    {
        return $this->search($criterias,1);
    }

    protected function search($criterias,$limit=null){
        $crit = Criteria::create();
        foreach ($criterias as $field=>$criteria) {
            $expr = Criteria::expr();
            $expr = $expr->eq($field,$criteria);
            $crit = $crit->andWhere($expr);
        }

        if($limit){
            $crit = $crit->setMaxResults($limit);
        }

        return $this->matching($crit);
    }

    public function findContaining($field,$value){
        return $this->searchIn($field,$value);
    }

    public function findOneContaining($field, $value)
    {
        return $this->searchIn($field,$value,1);
    }

    protected function searchIn($field,$value,$limit=null){
        $criteria = Criteria::create();
        $expr = Criteria::expr();
        $expr = $expr->memberOf($field,$value);
        $criteria = $criteria->andWhere($expr);

        if($limit){
            $criteria = $criteria->setMaxResults($limit);
        }
        return $this->matching($criteria);
    }


    public function random()
    {
        $keys = $this->getKeys();
        $key = array_rand($keys);
        return $this->get($keys[$key]);
    }

}