<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>daftar buku</title>
</head>

<body>
    <table>
        <tbody>
            <tr>
                <td>Title</td>
                <td>Author</td>
                <td>Description</td>
            </tr>


        </tbody>
        <?php
        foreach ($books as $book) {
            echo "<tr>
                <td>
                <a href='index.php?book='.$book->title." > ".$book->title.</a>
                </td>";
        }
        ?>



    </table>
</body>

</html>