<?php

namespace Laradium\Laradium\Documents\Base\Fields;

use Illuminate\Database\Eloquent\Model;
use Laradium\Laradium\Base\Field;
use Laradium\Laradium\Documents\Exceptions\NotDocumentableException;
use Laradium\Laradium\Documents\Interfaces\DocumentableInterface;

class EditDocument extends Field
{
    /**
     * @var string|null
     */
    protected $label;

    /**
     * EditDocument constructor.
     *
     * @param $parameters
     * @param Model $model
     * @throws NotDocumentableException
     */
    public function __construct($parameters, Model $model)
    {
        if (!in_array(DocumentableInterface::class, class_implements($model), true)) {
            throw new NotDocumentableException('The model isn\'t documentable');
        }

        parent::__construct($parameters, $model);

        $this->fieldName($model->getContentKey());
        $this->value($model->getContent() ?? '');
    }

    /**
     * @param $label
     * @return $this|Field
     */
    public function label($label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }
}