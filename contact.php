
<?php
    require_once("inc/init.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $to = "kendall.dewis@gmail.com";
        $from = $_POST["email"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_last_name"];
        $phone_number = $_POST["phone_number"];
        $subject = $_POST["motive"];

        $message = $first_name . " " . $last_name . " vous a écrit un message : \n\n" . $_POST["message"];

        $headers = "From:" . $to;
        mail($to, $subject, $message, $headers);

        foreach ($_POST as $key => $value) {
            $_POST[$index] = addslashes($value);
        }

        $count = $pdo->exec("INSERT INTO contact(first_name, last_name, email, phone_number, subject, message, date)
            VALUES(
            '$first_name', 
            '$last_name', 
            '$email', 
            '$phone_number', 
            '$subject', 
            '$message', 
            NOW()
            )
        ");

        if($count > 0) {
            $msg = "<div alert alert-success>
                Message bien envoyé !
            </div>";
        }

    }

    require_once("inc/header.php");
?>

<!-- Body content -->


<h1 class="text-center">Give us your informations</h1>
    <form class="row col-md-10" method="post">
        <div class="form-group col-md-6">
            <!-- <input type="hidden" name="id_member" value="<?php echo $id_member; ?>"> -->
            <label for="firstName">FirstName :</label>
            <input type="text" name="first_name" class="form-control" id="firstName" aria-describedby="firstName"
                placeholder="Enter your first name">
        </div>
        <div class="form-group col-md-6">
            <label label for="lastName">LastName :</label>
            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Enter your name">
        </div>
        <div class="form-group col-md-6">
            <label label for="name">Email :</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
        </div>
        <div class="form-group col-md-6">
            <label label for="name">phone_number :</label>
            <input type="phone_number" name="phone_number" class="form-control" id="phone_number"
                placeholder="Enter your phone number">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleFormControlSelect1">How can we help you?</label>
            <select class="form-control" id="exampleFormControlSelect1" name="motive">
                <option>I have a question for an order!</option>
                <option>I have a question on a product !</option>
                <option>I want to be in touch with the after sales service.</option>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="message">Message :</label>
            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
        </div>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>

<?php
    require_once("inc/footer.php");
?>