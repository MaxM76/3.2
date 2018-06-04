<?php

function getPriceFromSupplier()
{
    echo 'Посылаем запрос поставщику';
    return 0;
}

function getDimentionsFromSupplier()
{
    echo 'Посылаем запрос поставщику';
    return ["length" => 100, "width" => 50, "height" => 30];
}

function getGrossWeightFromSupplier()
{
    echo 'Посылаем запрос поставщику';
    return 1000;
}

function orderAutoVehicle($color, $fuelType, $capacity, $loadCapacity)
{
    return true;
}


function orderBallpointPen($colorsNmb, $colors)
{
    return true;
}

function orderDuck($breed, $age, $sex)
{
    return true;
}

function orderTVSet($color, $screenSize, $tuners)
{
    return true;
}


class GoodsClass
{
    private $dimentions = ["length" => 0, "width" => 0, "height" => 0];
    private $netWeight = 0;
    private $grossWeight = 0;
    private $purchasePrice = 0;
    private $price = 0;
    private $discount = 0;
    private $status = "absent";
    protected $category;
    private $name;
    private $discription;

    public function __construct($category, $name, $netWeight, $discription)
    {
        $this->category = $category;
        $this->name = $name;
        $this->netWeight = $netWeight;
        $this->discription = $name;
        echo 'Goods constructed';
    }

    public function __destruct()
    {
        echo 'Goods destructed';
    }

    public function getDimentions()
    {
        return $this->dimentions;
    }

    public function getNetWeight()
    {
        return $this->netWeight;
    }

    public function getGrossWeight()
    {
        return $this->grossWeight;
    }

    public function getPurchasePrice()
    {
        return $this->purchasePrice;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getSellingPrice()
    {
        return $this->price * (100 - $this->getDiscount());
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getDiscription()
    {
        return $this->discription;
    }

    public function bue()
    {
        echo 'Закупаем товар';
        $this->status = "in stock";
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    public function setDiscription($discription)
    {
        $this->discription = $discription;
    }

    public function sell()
    {
        echo 'Продаем товар';
        $this->status = "sold";
    }

    public function order()
    {
        echo 'Закзываем у поставщика, получаем закупочную цену и характеристики';
        $this->purchasePrice = getPriceFromSupplier();
        $this->dimentions = getDimentionsFromSupplier();
        $this->grossWeight = getGrossWeightFromSupplier();
        $this->status = "ordered";
    }

    public function showInfo()
    {
        echo $this->name . PHP_EOL;
        echo 'category ' . $this->category . PHP_EOL;
        echo 'discription: ' . $this->discription . PHP_EOL;
        echo 'length ' . $this->dimentions["length"] . PHP_EOL;
        echo 'width ' . $this->dimentions["width"] . PHP_EOL;
        echo 'height ' . $this->dimentions["height"] . PHP_EOL;
        echo 'netWeight ' . $this->netWeight;
        echo 'grossWeight ' . $this->grossWeight;
        echo 'price ' . $this->price;
        echo 'discount ' . $this->discount;
        echo 'status ' . $this->status;
        echo 'SellingPrice ' . $this->getSellingPrice();
    }
}

interface VehicleInterface
{
    public function proposeInsurance();
    public function proposeVechicleRegistration();
}

class AutoVehicleClass extends GoodsClass implements VehicleInterface
{
    private $brand;
    private $model;
    private $type;
    private $color = "invisible";
    private $fuelType = "none";
    private $capacity = 0;
    private $loadCapacity = 0;

    public function __construct($netWeight, $discription, $brand, $model, $type)
    {
        parent::__construct('AutoVehicle', $brand . $model, $netWeight, $discription);
        $this->brand = $brand;
        $this->model = $model;
        $this->type = $type;
        echo 'AutoVehicle constructed';
    }

    public function order($color, $fuelType, $capacity, $loadCapacity)
    {
        parent::order();
        if (orderAutoVehicle($color, $fuelType, $capacity, $loadCapacity)) {
            $this->color = $color;
            $this->fuelType = $fuelType;
            $this->capacity = $capacity;
            $this->loadCapacity = $loadCapacity;
        }
    }

    public function proposeInsurance()
    {
        echo 'Купите полис Осаго';
    }

    public function proposeVechicleRegistration()
    {
        echo 'Зарегистрируйте автомобиль';
    }
}

interface WritingSuppliesInterface
{
    public function proposeInscription();
    public function proposeLessons();
}

class BallpointPenClass extends GoodsClass implements WritingSuppliesInterface
{
    private $brand;
    private $model;
    private $type;
    private $colorsNmb = 0;
    private $colors = ['invisible'];

    public function __construct($netWeight, $discription, $brand, $model, $type)
    {
        parent::__construct('BallpointPen', $brand . $model, $netWeight, $discription);
        $this->brand = $brand;
        $this->model = $model;
        $this->type = $type;
        echo 'BallpointPen constructed';
    }

    public function order($colors, $colorsNmb)
    {
        parent::order();
        if (orderBallpointPen($colorsNmb, $colors)) {
            $this->colors = $colors;
            $this->colorsNmb = $colorsNmb;
        }
    }

    public function proposeInscription()
    {
        echo 'Сделайте дарственную надпись';
    }

    public function proposeLessons()
    {
        echo 'Не хотите получить уроки правописания, каллиграфии, графики, рисования?';
    }
}

interface DomesticCattleInterface
{
    public function proposeVeterinarianService();
    public function proposeFarmConstruction();
}

class DuckClass extends GoodsClass implements DomesticCattleInterface
{
    private $breed;
    private $age;
    private $sex;

    public function __construct($name, $netWeight, $discription)
    {
        parent::__construct('Domestic cattle', $name, $netWeight, $discription);
        echo 'Duck constructed';
    }

    public function order($breed, $age, $sex)
    {
        parent::order();
        if (orderDuck($breed, $age, $sex)) {
            $this->breed = $breed;
            $this->age = $age;
            $this->sex = $sex;
        }
    }

    public function proposeVeterinarianService()
    {
        echo 'Закажите обслуживание у ветеринара';
    }

    public function proposeFarmConstruction()
    {
        echo 'А ферма нужна?';
    }

}

interface AudioVideoEquipmentInterface
{
    public function proposeCableService();
    public function proposeHomeTheatreInstallation();
}

class TVSetClass extends GoodsClass implements AudioVideoEquipmentInterface
{
    private $brand;
    private $model;
    private $type;
    private $color;
    private $screenSize;
    private $tuners;

    public function __construct($netWeight, $discription, $brand, $model, $type)
    {
        parent::__construct('TVSet', $brand . $model, $netWeight, $discription);
        $this->brand = $brand;
        $this->model = $model;
        $this->type = $type;
        echo 'TVSet constructed';
    }

    public function order($color, $screenSize, $tuners)
    {
        parent::order();
        if (orderTVSet($color, $screenSize, $tuners)) {
            $this->color = $color;
            $this->screenSize = $screenSize;
            $this->tuners = $tuners;
        }
    }

    public function proposeCableService()
    {
        echo 'Закажите кабельное/спутниковое';
    }

    public function proposeHomeTheatreInstallation()
    {
        echo 'А домашний кинотеатр нужен?';
    }
}

$sorento = new AutoVehicleClass(1650, 'bla-bla-bla', 'KIA', 'Sorento', 'diesel');
$lancer = new AutoVehicleClass(1350, 'bla-bla-bla', 'Mitsibishi', 'Lancer', 'gasoline');
$parker = new BallpointPenClass(0.5, 'bla-bla-bla', 'Parker', 'pp-105-98', 'ink-pen');
$nonamePen = new BallpointPenClass(0.0, 'bla-bla-bla', 'noname', '', 'gel-pen');
$pekinDuck = new DuckClass('Пекинская утка', 1.3, 'bla-bla-bla');
$indoDuck = new DuckClass('Индоутка', 1.1, 'bla-bla-bla');
$appleTV = new TVSetClass (17.5, 'bla-bla-bla', 'Apple', '5554gfdd-789', 'LCD');
$Horizont = new TVSetClass(30.5, 'bla-bla-bla', 'Horizont', '1656984-788', 'vintage TV');