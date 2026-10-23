<?php
/*
 * Vehicle Fleet Management System
 * This program demonstrates classes, inheritance, static properties,
 * method overriding, object instantiation, comparison, and form handling.
 */

class Vehicle
{
    // Common properties shared by every vehicle type.
    protected string $brand;
    protected string $model;
    protected int $year;
    protected float $price;

    // This static property tracks all Vehicle objects created.
    private static int $vehicleCount = 0;

    // The constructor initializes common vehicle information.
    public function __construct(
        string $brand,
        string $model,
        int $year,
        float $price
    ) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->price = $price;

        self::$vehicleCount++;
    }

    // This method displays information common to every vehicle.
    public function displayInfo(): string
    {
        return "Brand: " . htmlspecialchars($this->brand) . "<br>" .
               "Model: " . htmlspecialchars($this->model) . "<br>" .
               "Year: " . $this->year . "<br>" .
               "Price: $" . number_format($this->price, 2);
    }

    // This method compares two vehicles using price or year.
    public function compareVehicles(Vehicle $other, string $criterion): string
    {
        if ($criterion === "price") {
            if ($this->price > $other->price) {
                return $this->model . " is more expensive than " .
                       $other->model . ".";
            } elseif ($this->price < $other->price) {
                return $this->model . " is less expensive than " .
                       $other->model . ".";
            }

            return $this->model . " and " . $other->model .
                   " have the same price.";
        }

        if ($criterion === "year") {
            if ($this->year > $other->year) {
                return $this->model . " is newer than " .
                       $other->model . ".";
            } elseif ($this->year < $other->year) {
                return $this->model . " is older than " .
                       $other->model . ".";
            }

            return $this->model . " and " . $other->model .
                   " have the same model year.";
        }

        return "Invalid comparison criterion.";
    }

    // Static method allows the application to retrieve the object count.
    public static function getVehicleCount(): int
    {
        return self::$vehicleCount;
    }
}


// Car inherits the common properties and methods from Vehicle.
class Car extends Vehicle
{
    private int $numberOfDoors;

    public function __construct(
        string $brand,
        string $model,
        int $year,
        float $price,
        int $numberOfDoors
    ) {
        parent::__construct($brand, $model, $year, $price);
        $this->numberOfDoors = $numberOfDoors;
    }

    // Override displayInfo() to include the Car-specific property.
    public function displayInfo(): string
    {
        return "<strong>Car</strong><br>" .
               parent::displayInfo() . "<br>" .
               "Number of Doors: " . $this->numberOfDoors;
    }
}


// Truck inherits the common properties and methods from Vehicle.
class Truck extends Vehicle
{
    private float $cargoCapacity;

    public function __construct(
        string $brand,
        string $model,
        int $year,
        float $price,
        float $cargoCapacity
    ) {
        parent::__construct($brand, $model, $year, $price);
        $this->cargoCapacity = $cargoCapacity;
    }

    // Override displayInfo() to include the Truck-specific property.
    public function displayInfo(): string
    {
        return "<strong>Truck</strong><br>" .
               parent::displayInfo() . "<br>" .
               "Cargo Capacity: " . $this->cargoCapacity . " kg";
    }
}


// Motorcycle inherits the common properties and methods from Vehicle.
class Motorcycle extends Vehicle
{
    private string $handlebarType;

    public function __construct(
        string $brand,
        string $model,
        int $year,
        float $price,
        string $handlebarType
    ) {
        parent::__construct($brand, $model, $year, $price);
        $this->handlebarType = $handlebarType;
    }

    // Override displayInfo() to include the Motorcycle-specific property.
    public function displayInfo(): string
    {
        return "<strong>Motorcycle</strong><br>" .
               parent::displayInfo() . "<br>" .
               "Handlebar Type: " . htmlspecialchars($this->handlebarType);
    }
}


// ---------------------------------------------------------
// Sample objects demonstrate inheritance and overriding.
// ---------------------------------------------------------

$sampleCar = new Car("Toyota", "Camry", 2025, 28500, 4);
$sampleTruck = new Truck("Ford", "F-150", 2024, 45000, 1500);
$sampleMotorcycle = new Motorcycle(
    "Honda",
    "Rebel 500",
    2025,
    6800,
    "Cruiser"
);


// ---------------------------------------------------------
// Process the HTML form when the user submits a vehicle.
// ---------------------------------------------------------

$submittedVehicle = null;
$formMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $vehicleType = $_POST["vehicleType"] ?? "";
    $brand = trim($_POST["brand"] ?? "");
    $model = trim($_POST["model"] ?? "");
    $year = filter_input(INPUT_POST, "year", FILTER_VALIDATE_INT);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT);

    if ($brand === "" || $model === "" || $year === false ||
        $price === false || $year === null || $price === null) {

        $formMessage = "Please provide valid vehicle information.";

    } else {

        if ($vehicleType === "Car") {

            $numberOfDoors = filter_input(
                INPUT_POST,
                "numberOfDoors",
                FILTER_VALIDATE_INT
            );

            if ($numberOfDoors !== false && $numberOfDoors !== null) {
                $submittedVehicle = new Car(
                    $brand,
                    $model,
                    $year,
                    $price,
                    $numberOfDoors
                );
            }

        } elseif ($vehicleType === "Truck") {

            $cargoCapacity = filter_input(
                INPUT_POST,
                "cargoCapacity",
                FILTER_VALIDATE_FLOAT
            );

            if ($cargoCapacity !== false && $cargoCapacity !== null) {
                $submittedVehicle = new Truck(
                    $brand,
                    $model,
                    $year,
                    $price,
                    $cargoCapacity
                );
            }

        } elseif ($vehicleType === "Motorcycle") {

            $handlebarType = trim($_POST["handlebarType"] ?? "");

            if ($handlebarType !== "") {
                $submittedVehicle = new Motorcycle(
                    $brand,
                    $model,
                    $year,
                    $price,
                    $handlebarType
                );
            }
        }

        if ($submittedVehicle !== null) {
            $formMessage = "New vehicle added successfully.";
        } else {
            $formMessage = "Please provide a valid vehicle-specific value.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vehicle Fleet Management</title>
</head>

<body>

<h1>Car Dealership Vehicle Fleet</h1>

<h2>Add a New Vehicle</h2>

<form method="POST" action="">

    <label for="vehicleType">Vehicle Type:</label>
    <select name="vehicleType" id="vehicleType" required>
        <option value="">Select Type</option>
        <option value="Car">Car</option>
        <option value="Truck">Truck</option>
        <option value="Motorcycle">Motorcycle</option>
    </select>
    <br><br>

    <label for="brand">Brand:</label>
    <input type="text" name="brand" id="brand" required>
    <br><br>

    <label for="model">Model:</label>
    <input type="text" name="model" id="model" required>
    <br><br>

    <label for="year">Year:</label>
    <input type="number" name="year" id="year" min="1886" max="2100" required>
    <br><br>

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" min="0" required>
    <br><br>

    <label for="numberOfDoors">Number of Doors:</label>
    <input type="number" name="numberOfDoors" id="numberOfDoors" min="1">
    <br><br>

    <label for="cargoCapacity">Cargo Capacity (kg):</label>
    <input type="number" name="cargoCapacity" id="cargoCapacity" step="0.1" min="0">
    <br><br>

    <label for="handlebarType">Handlebar Type:</label>
    <input type="text" name="handlebarType" id="handlebarType">
    <br><br>

    <button type="submit">Add Vehicle</button>

</form>

<hr>

<?php if ($formMessage !== ""): ?>
    <h3><?php echo htmlspecialchars($formMessage); ?></h3>
<?php endif; ?>

<?php if ($submittedVehicle !== null): ?>

    <h2>Submitted Vehicle</h2>

    <p>
        <?php echo $submittedVehicle->displayInfo(); ?>
    </p>

<?php endif; ?>


<h2>Sample Vehicles</h2>

<h3>Sample Car</h3>
<p><?php echo $sampleCar->displayInfo(); ?></p>

<h3>Sample Truck</h3>
<p><?php echo $sampleTruck->displayInfo(); ?></p>

<h3>Sample Motorcycle</h3>
<p><?php echo $sampleMotorcycle->displayInfo(); ?></p>


<h2>Vehicle Comparison</h2>

<p>
    <?php echo $sampleCar->compareVehicles($sampleTruck, "price"); ?>
</p>

<p>
    <?php echo $sampleCar->compareVehicles($sampleTruck, "year"); ?>
</p>


<h2>Total Vehicle Instances</h2>

<p>
    Total vehicle objects created:
    <strong><?php echo Vehicle::getVehicleCount(); ?></strong>
</p>

</body>
</html>