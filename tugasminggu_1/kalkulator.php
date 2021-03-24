<!DOCTYPE html>
<html>
	<head>
		<title>kalkulator</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		
            <h2>KALKULATOR SEDERHANA</h2>
		    <form method="post" action="kalkulator.php">
		        <input name="number1" type="text" class="form-control" style="width: 150px; display: inline" />
		        <input name="number2" type="text" class="form-control" style="width: 150px; display: inline" />
                <select name="operation" style="height: 30px; display: inline">
		        	<option value="+">+</option>
		            <option value="-">-</option>
		            <option value="*">*</option>
		            <option value="/">/</option>
		        </select>
		        <input name="submit" type="submit" value="Calculate" class="btn btn-primary" />
                <?php
                ?>
		    </form>
	    
		</div>
	
        <div class="container" style="margin-top: 10px">
		
        <?php
        
            if(isset($_POST['submit']))
            {
                
                if(is_numeric($_POST['number1']) && is_numeric($_POST['number2']))
                {
                    
                    if($_POST['operation'] == '+')
                    {
                        $total = $_POST['number1'] + $_POST['number2'];	
                    }
                    if($_POST['operation'] == '-')
                    {
                        $total = $_POST['number1'] - $_POST['number2'];	
                    }
                    if($_POST['operation'] == '*')
                    {
                        $total = $_POST['number1'] * $_POST['number2'];	
                    }
                    if($_POST['operation'] == '/')
                    {
                        $total = $_POST['number1'] / $_POST['number2'];	
                    }
                    
                    echo "<h1>{$_POST['number1']} {$_POST['operation']} {$_POST['number2']} = {$total}</h1>";
                
                } else {
                    
                    echo 'Tidak dapat ditemukan';
                
                }
            }
        
        ?>
    

	</body>
</html>