<?php

require_once 'Ingredient.php';

use Ingredient\Ingredient as Ingredient;

class Entree
{
    protected $name;
    protected $ingredients = array();

    /* Свойство $name объявлено закрытым, и поэтому ниже
    предоставляется метод для чтения его значения */
    public function getName()
    {
        return $this->name;
    }

    public function __construct(string &$name = "defaultName", array &$ingredients = array())
    {
        $this->name = $name;
        $this->ingredients = $ingredients;
    }

    public function hasIngredient($ingredient)
    {
        return in_array($ingredient, $this->ingredients);
    }
}

class newEntree extends Entree
{
    public function __construct($name, $ingredients)
    {
        parent::__construct($name, $ingredients);

        $this->ingredients = $ingredients;
    }

    public function getEntreeCost(): float
    {
        $sum = 0;

        foreach ($this->ingredients as $ingredient) {
            $sum += $ingredient->getCost();
        }

        return $sum;
    }
}

$water = new Ingredient('water', 0);

$newEntree = new newEntree('Soup', array(
    $water = new Ingredient('Water', 0),
    $tomatoes = new Ingredient('Tomatoes', 5.4),
    $onion = new Ingredient('Onion', 3.2)
));


echo "<pre>";
var_dump($newEntree);
echo "</pre>";
echo $newEntree->getName();
echo "<br>";
echo $newEntree->getEntreeCost();