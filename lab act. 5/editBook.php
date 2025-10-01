<?php

require_once "library.php";
$bookObj = new Library();

$book = [];
$error = [];

$submit_error = "";
$submit_success = "";
$duplicate_title_found = false;
$bid = null;

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $bid = trim(htmlspecialchars($_GET["id"]));
        $book = $bookObj->fetchBook($bid);
        if(!$book){
            echo"<a href='viewBook.php'>View Book</a>";
            exit("Book not found");
        }
    }else{
        echo"<a href='viewBook.php'>View Book</a>";
        exit("Book not found");
    }
}

else if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $bid = trim(htmlspecialchars($_POST["id"]));
    $book["id"] = $bid;
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
                if ($databook["title"] == $book["title"] && $databook["id"] != $bid)
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
            
            if ($bookObj->editBook($bid))
                $submit_success = "Book was updated successfully";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <style>
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

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #ffffffff;
            padding: 30px 40px;
            border: 1px solid #000000ff;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            color: #222;
            font-weight: bold;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            color: #000000ff;
        }

        label span {
            color: red;
            font-weight: normal;
        }

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

        input:focus, select:focus {
            border-color: #000000ff;
            outline: none;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
        }

        .error {
            color: red;
            font-size: 14px;
            margin: 4px 0 0 0;
        }

        input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            border: 1px solid #000000ff;
            color: #000000ff;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
            background: #fff;
        }
        
        input[type="submit"]:hover {
            background: #f0f0f0;
        }
        
        button {
            display: block;
            margin: 20px auto 0 auto;
            background: #efefefff;
            border: 1px solid #000000ff;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
        
        button a {
            text-decoration: none;
            color: #000;
        }
        
        .success {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Book</h1>

        <form action="" method="post">
            <input type="hidden" name="id" value="<?= isset($book['id']) ? $book['id'] : ''; ?>">

            <label for="title">Title <span>*</span></label>
            <input type="text" name="title" id="title" value="<?= isset($book["title"]) ? $book["title"] : ''; ?>">
            <p class="error"><?= isset($error["title"]) ? $error["title"] : ''; ?></p>

            <label for="genre">Genre <span>*</span></label>
            <select name="genre" id="genre">
                <option value="">--Select Genre--</option>
                <option value="History" <?php if(isset($book['genre']) && $book['genre'] == "History") echo "selected"; ?>>History</option>
                <option value="Science" <?php if(isset($book['genre']) && $book['genre'] == "Science") echo "selected"; ?>>Science</option>
                <option value="Fiction" <?php if(isset($book['genre']) && $book['genre'] == "Fiction") echo "selected"; ?>>Fiction</option>
            </select>
            <!-- DEBUG: Show what genre value we have -->
            <small style="color: blue;">Current genre from database: "<?= isset($book['genre']) ? $book['genre'] : 'NOT SET'; ?>"</small>
            <p class="error"><?= isset($error["genre"]) ? $error["genre"] : ''; ?></p>

            <label for="author">Author <span>*</span></label>
            <input type="text" name="author" id="author" value="<?= isset($book["author"]) ? $book["author"] : ''; ?>">
            <p class="error"><?= isset($error["author"]) ? $error["author"] : ''; ?></p>

            <label for="publication_year">Publication year <span>*</span></label>
            <input type="text" name="publication_year" id="publication_year" value="<?= isset($book["publication_year"]) ? $book["publication_year"] : ''; ?>">
            <p class="error"><?= isset($error["publication_year"]) ? $error["publication_year"] : ''; ?></p>
            
            <label for="publisher">Publisher</label>
            <input type="text" name="publisher" id="publisher" value="<?= isset($book["publisher"]) ? $book["publisher"] : ''; ?>">

            <label for="copies">Copies <span>*</span></label>
            <input type="text" name="copies" id="copies" value="<?= isset($book["copies"]) ? $book["copies"] : ''; ?>">
            <p class="error"><?= isset($error["copies"]) ? $error["copies"] : ''; ?></p>

            <input type="submit" value="Save Changes">
            
            <?php if($submit_error): ?>
                <p class="error"><?= $submit_error; ?></p>
            <?php endif; ?>
            
            <?php if($submit_success): ?>
                <p class="success"><?= $submit_success; ?></p>
            <?php endif; ?>
        </form>
        
        <button><a href="viewBook.php">View Book List</a></button>
    </div>
</body>
</html>
