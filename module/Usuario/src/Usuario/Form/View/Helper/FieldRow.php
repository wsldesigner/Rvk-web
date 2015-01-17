<?php
/**
 * Created by PhpStorm.
 * User: wesley
 * Date: 29/12/14
 * Time: 22:26
 */

namespace Usuario\Form\View\Helper;


use Usuario\Form\UsuarioForm;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRow;

class FieldRow extends FormRow {

    public function render(ElementInterface $element){
        $escapeHtmlHelper    = $this->getEscapeHtmlHelper();
        $labelHelper         = $this->getLabelHelper();
        $elementHelper       = $this->getElementHelper();
        $elementErrorsHelper = $this->getElementErrorsHelper();

        $label           = $element->getLabel();
        $inputErrorClass = $this->getInputErrorClass();

        $errorInputClass = '';

        $elementoErroCustom = new \Usuario\Form\View\Helper\FormElementErros();


        if (isset($label) && '' !== $label) {
            // Translate the label
            if (null !== ($translator = $this->getTranslator())) {
                $label = $translator->translate(
                    $label, $this->getTranslatorTextDomain()
                );
            }
        }

        // Does this element have errors ?
        if (count($element->getMessages()) > 0 && !empty($inputErrorClass)) {
            $classAttributes = ($element->hasAttribute('class') ? $element->getAttribute('class') . ' ' : '');
            $classAttributes = $classAttributes . $inputErrorClass;

            $element->setAttribute('class', $classAttributes);
            $errorInputClass = 'has-error';
        }

        if ($this->partial) {
            $vars = array(
                'element'           => $element,
                'label'             => $label,
                'labelAttributes'   => $this->labelAttributes,
                'labelPosition'     => $this->labelPosition,
                'renderErrors'      => $this->renderErrors,
            );

            return $this->view->render($this->partial, $vars);
        }

        if ($this->renderErrors) {
            //$elementErrors = $elementErrorsHelper->render($element);
            $elementErrors = $elementoErroCustom->render($element);

        }

        $elementString = $elementHelper->render($element);



        // hidden elements do not need a <label> -https://github.com/zendframework/zf2/issues/5607
        $type = $element->getAttribute('type');
        if (isset($label) && '' !== $label && $type !== 'hidden') {

            $labelAttributes = array();

            if ($element instanceof LabelAwareInterface) {
                $labelAttributes = $element->getLabelAttributes();
            }

            if (! $element instanceof LabelAwareInterface || ! $element->getLabelOption('disable_html_escape')) {
                $label = $escapeHtmlHelper($label);
            }

            if (empty($labelAttributes)) {
                $labelAttributes = $this->labelAttributes;
            }

            // Multicheckbox elements have to be handled differently as the HTML standard does not allow nested
            // labels. The semantic way is to group them inside a fieldset
            if ($type === 'multi_checkbox'
                || $type === 'radio'
                || $element instanceof MonthSelect
            ) {
                $markup = sprintf(
                    '<fieldset><legend>%s</legend>%s</fieldset>',
                    $label,
                    $elementString);
            } else {
                // Ensure element and label will be separated if element has an `id`-attribute.
                // If element has label option `always_wrap` it will be nested in any case.
                if ($element->hasAttribute('id')
                    && ($element instanceof LabelAwareInterface && !$element->getLabelOption('always_wrap'))
                ) {
                    $labelOpen = '';
                    $labelClose = '';
                    $label = $labelHelper($element);
                } else {
                    $labelOpen  = $labelHelper->openTag($labelAttributes);
                    $labelClose = $labelHelper->closeTag();
                }

                if ($label !== '' && (!$element->hasAttribute('id'))
                    || ($element instanceof LabelAwareInterface && $element->getLabelOption('always_wrap'))
                ) {
                    $label = '<span>' . $label . '</span>';
                }

                // Button element is a special case, because label is always rendered inside it
                if ($element instanceof Button) {
                    $labelOpen = $labelClose = $label = '';
                }
                //print_r($elementString);
                switch ($this->labelPosition) {
                    case self::LABEL_PREPEND:
                      /**  $markup = '<div class="form-group">
                                        <label>'.
                                            $labelOpen . $label . $elementString . $labelClose
                                        .'</label>
                                  </div>';*/
                      $markup = '<div class="form-group '.$errorInputClass.'">
                                    <label class="col-sm-2 control-label '.$errorInputClass.' ">
                                        '.$label.'
                                    </label>
                                    <div class="col-sm-10">
                                        '.$elementString.'
                                    </div>
                                 </div>';

                        break;
                    case self::LABEL_APPEND:
                    default:
                        //$markup = $labelOpen . $elementString . $label . $labelClose;
                    $markup = '<div class="form-group '.$errorInputClass.'">
                                    <label class="col-sm-2 control-label '.$errorInputClass.'">
                                        '.$label.'
                                    </label>
                                    <div class="col-sm-10">
                                        '.$elementString.'
                                    </div>
                                 </div>';
                        break;
                }
            }

            if ($this->renderErrors) {

                $markup .= $elementErrors;
            }
        } else {
            if ($this->renderErrors) {
                $markup = $elementString . $elementErrors;
            } else {
                $markup = $elementString;
            }
        }
        //print_r($elementErrors);
        return $markup;
    }

}