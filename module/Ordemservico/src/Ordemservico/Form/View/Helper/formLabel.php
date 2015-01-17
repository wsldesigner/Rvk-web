<?php
/**
 * Created by PhpStorm.
 * User: wesley
 * Date: 29/12/14
 * Time: 23:00
 */

namespace Ordemservico\Form\View\Helper;


use Doctrine\Common\Proxy\Exception\InvalidArgumentException;

class formLabel extends \Zend\Form\View\Helper\FormLabel {

    public function openTag($attributesOrElement = null)
    {
        if (null === $attributesOrElement) {
            return '<abc>';
        }

        if (is_array($attributesOrElement)) {
            $attributes = $this->createAttributesString($attributesOrElement);
            return sprintf('<label %s>', $attributes);
        }

        if (!$attributesOrElement instanceof ElementInterface) {
            throw new  InvalidArgumentException(sprintf(
                '%s expects an array or Zend\Form\ElementInterface instance; received "%s"',
                __METHOD__,
                (is_object($attributesOrElement) ? get_class($attributesOrElement) : gettype($attributesOrElement))
            ));
        }

        $id = $this->getId($attributesOrElement);
        if (null === $id) {
            throw new DomainException(sprintf(
                '%s expects the Element provided to have either a name or an id present; neither found',
                __METHOD__
            ));
        }

        $labelAttributes = array();
        if ($attributesOrElement instanceof LabelAwareInterface) {
            $labelAttributes = $attributesOrElement->getLabelAttributes();
        }

        $attributes = array('for' => $id);

        if (!empty($labelAttributes)) {
            $attributes = array_merge($labelAttributes, $attributes);
        }

        $attributes = $this->createAttributesString($attributes);
        return sprintf('<label %s>', $attributes);
    }

    /**
     * Return a closing label tag
     *
     * @return string
     */
    public function closeTag()
    {
        return '</label>';
    }

}