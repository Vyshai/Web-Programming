<?php

require_once "library.php";
$bookObj = new Library();

$book = ["title"=>"", "author"=>"", "genre"=>"", "publication_year"=>"", "publisher"=>"", "copies"=>""];


$error = ["title"=>"", "author"=>"", "genre"=>"", "publication_year"=>"", "copies"=>""];
$submit_error = "";
$submit_success = "";
$duplicate_title_found = false;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $book["title"] = trim(htmlspecialchars($_POST["title"]));
    $book["author"] = trim(htmlspecialchars($_POST["author"]));
    $book["genre"] = trim(htmlspecialchars($_POST["genre"]));
    $book["publication_year"] = trim(htmlspecialchars($_POST["publication_year"]));
    $book["publisher"] = trim(htmlspecialchars($_POST["publisher"]));
    $book["copies"] = trim(htmlspecialchars($_POST["copies"]));

    if (empty($book["title"]))
        $error["title"] = "Title is required";

    if (empty($book["author"]))
        $error["author"] = "Author is required";

    if (empty($book["genre"]))
        $error["genre"] = "Genre is required";

    if (empty($book["publication_year"]))
        $error["publication_year"] = "Publication year is required";

    else if (!is_numeric($book["publication_year"]))
        $error["publication_year"] = "Publication year must be a number";

    else if ($book["publication_year"] > date("Y"))
        $error["publication_year"] = "Publication year must not be in the future";

    if (empty($book["copies"]))
        $error["copies"] = "Copies is required";

    else if (!is_numeric($book["copies"]))
        $error["copies"] = "Copies must be a number";

    if (empty(array_filter($error)))
    {
        $viewBook = new Library();
        $booksList = $viewBook->viewBook();
        if (is_array($booksList)) {
            foreach($booksList as $databook)
            {
                if ($databook["title"] == $book["title"])
                {
                    $duplicate_title_found = true;
                    break;
                }
            }
        }
        
        if ($duplicate_title_found)
            $submit_error = "This title is already in the database";
        else
        {
            $bookObj->title = $book["title"];
            $bookObj->author = $book["author"];
            $bookObj->genre = $book["genre"];
            $bookObj->publication_year = $book["publication_year"];
            $bookObj->publisher = $book["publisher"];
            $bookObj->copies = $book["copies"];
            
            if ($bookObj->addBook())
                $submit_success = "Book was added successfully";
        }      
    }
    else
        $submit_error = "You must fill out the required forms";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Add Book</title>
        <style>
        /* Reset some default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            color: #333;
            line-height: 1.6;
        }

        /* Container */
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #ffffffff;
            padding: 30px 40px;
            border: 1px solid #000000ff;
        }

        /* Heading */
        .container h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            color: #222;
            font-weight: bold;
        }

        /* Form labels */
        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            color: #000000ff;
        }

        /* Required star */
        label span {
            color: red;
            font-weight: normal;
        }

        /* Inputs and select */
        input[type="text"], 
        input[type="number"], 
        select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: 0.3s ease;
        }

        /* Input focus effect */
        input:focus, select:focus {
            border-color: #000000ff;
            outline: none;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
        }

        /* Error messages */
        .error {
            color: red;
            font-size: 14px;
            margin: 4px 0 0 0;
        }

        /* Submit button */
        input[type="submit"] {
            margin-top: 190px;
            width: 18%;
            padding: 12px;
            border: 1px solid #000000ff;
            color: #000000ff;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            
        }
        /* View book button */
        button {
            display: block;
            margin: 20px auto 0 auto;
            background: #efefefff;
            border: 1px solid #000000ff;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
            <h1>Book Form</h1>

            <form action="" method="post">

            <label for="title">Title <span>*</span></label>
            <input type="text" name="title" id="title" value="<?= $book["title"]; ?>">
            <p class="error"><?= $error["title"]; ?></p>

            <label for="genre">Genre <span>*</span></label>
            <select name="genre" id="genre">
                <option value="">--Select Genre--</option>
                <option value="History">History</option>
                <option value="Science">Science</option>
                <option value="Fiction">Fiction</option>
            </select>
            <p class="error"><?= $error["genre"]; ?></p>

            <label for="author">Author <span>*</span></label>
            <input type="text" name="author" id="author" value="<?= $book["author"]; ?>">
            <p class="error"><?= $error["author"]; ?></p>

            <label for="publication_year">Publication year <span>*</span></label>
            <input type="text" name="publication_year" id="publication_year" value="<?= $book["publication_year"]; ?>">
            <p class="error"><?= $error["publication_year"]; ?></p>
            <label for="publisher">Publisher</label>
            <input type="text" name="publisher" id="publisher" value="<?= $book["publisher"]; ?>">

            <label for="copies">Copies <span>*</span></label>
            <input type="text" name="copies" id="copies" value="<?= $book["copies"]; ?>">
            <p class="error"><?= $error["copies"]; ?></p><br>

            <input type="submit" value="Add Book">
            <p class="error"><?= $submit_error; ?></p>
            <p style="color: green; margin: 0;"><?= $submit_success; ?></p>
            </form>   
            <br>
            <button><a href="viewBook.php">View Book List</a></button>
    </div>
</body>

</html>