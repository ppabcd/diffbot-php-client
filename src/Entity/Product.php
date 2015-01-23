<?php

namespace Swader\Diffbot\Entity;

use Swader\Diffbot\Abstracts\Entity;

class Product extends Entity
{
    /**
     * Checks if the product has been determined available
     * @return bool
     */
    public function isAvailable()
    {
        return (bool)$this->objects['availability'];
    }

    /**
     * Returns the product offer price, in USD, as a floating point number
     * @return float
     */
    public function getOfferPrice()
    {
        return (float)trim($this->objects['offerPrice'], '$');
    }

    /**
     * Returns the brand, as determined by Diffbot
     * @return string
     */
    public function getBrand()
    {
        return $this->objects['brand'];
    }

    /**
     * Returns the title, as read by Diffbot
     * @return string
     */
    public function getTitle()
    {
        return $this->objects['title'];
    }
}