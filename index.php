<?php
$nameerr = $emailerr = $websiteerr = $gendererr = "";
$name = $email = $website = $comment = $gender = "";

if (isset($_POST['submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['name'])) {
            $nameerr = "Name is required";
        } else {
            $name = check_valid($_POST['name']);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameerr = 'Only letters and white space allowed';
            }
        }
        if (empty($_POST['email'])) {
            $emailerr = 'Email is required';
        } else {
            $email = check_valid($_POST['email']);
            if (!preg_match("/^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(.\[a-z]{2,8})?$/", $email)) {
                $emailerr = 'Email is invalid';
            }
        }
        if (empty($_POST['website'])) {
            $websiteerr = 'Website can not be empty';
        } else {
            $website = check_valid($_POST['website']);
            if (!preg_match("/^\b(?:(?:https?|ftp):\/\/|www\.)[-a-z\d+&@#\/%?=~_|!;.,;]*[-a-z\d+&@#\/%=~_|]$/i", $website)) {
                $websiteerr = 'Invalid URL';
            }
        }
        if (empty($_POST['comment'])) {
            $comment = '';
        } else {
            $comment = check_valid($_POST['comment']);
        }
        if (empty($_POST['gender'])) {
            $gendererr = 'Gender is required';
        } else {
            $gender = check_valid($_POST['gender']);
        }

    } else {
        echo "Your request Method is not Valid";
    }

}

# define check_valid function
function check_valid($value)
{
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation of PHP</title>
    <style>
     /* *{
         padding: 0px;
         margin: 0px;
         box-sizing: border-box;
     } */
     label{
         display: block;
     }
     input[type='submit']{
         display: block;
         padding: 5px 6px;
         text-transform: uppercase;
         font-family: Arial, Helvetica, sans-serif;
         margin-top: 15px;
     }
     .error{
         color: red;
     }
    </style>
</head>
<body>
    <h2>Form Validation with PHP</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="" value="<?php echo htmlspecialchars($name) ?>">
        <p class="error"><?php echo $nameerr; ?></p>

        <label for="email">Email</label>
        <input type="text" name="email" id="" value="<?php echo htmlspecialchars($email) ?>">
        <p class="error"><?php echo $emailerr; ?></p>

        <label for="website">Website:</label>
        <input type="text" name="website" id="" value="<?php echo htmlspecialchars($website) ?>">
        <p class="error"><?php echo $websiteerr; ?></p>

        <label for="comment">Comment:</label>
        <textarea name="comment" id="" cols="30" rows="10" placeholder="optional to fill*"></textarea>

        <label for="gender">Gender:</label>
        <input type="radio" name="gender" id=""

        <?php
// for male
if (isset($gender) && $gender == "Female") {
    echo "checked";
}
?> value="Female">Female
        <input type="radio" name="gender" id=""
        <?php
// for female
if (isset($gender) && $gender == "Male") {
    echo "checked";
}
?>
         value="Male">Male
        <input type="radio" name="gender" id=""
        <?php
if (isset($gender) && $gender == "Others") {
    echo "checked";
}
?>
         value="others">Others

         <p class="error"><?php echo $gendererr; ?></p>

        <input type="submit" value="submit" name="submit">
    </form>
<?php

echo "<h1>The User Input Data</h1>";
echo "The FullName of the user is: " . $name . "<br>";
echo "The Email of the user is: " . $email . "<br>";
echo "The Website of the user is: " . $website . "<br>";
echo "The Comment of the user is: " . $comment . "<br>";
echo "The Gender of the user is: " . $gender . "<br>";

?>
</body>
</html>