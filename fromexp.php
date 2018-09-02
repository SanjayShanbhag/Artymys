<!DOCTYPE html>
<html lang="en">
<html>
  <head>
    <title> Artymys </title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <meta name="theme-color" content="#1A237E">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link href="CSS/ninja-slider.css" rel="stylesheet" type="text/css" />
      <script src="javascript/ninja-slider.js" type="text/javascript"></script>
    
</head>

<body>
<form class="form-horizontal" method="POST" action="exp2.php" enctype="multipart/formdata">
<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Profile Picture:</label>
      <div class="col-sm-10">          
        <input type="file" name="image"/><br>
      </div>
    </div>
        
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name="submit">Submit</button>
      </div>
    </div>

</form>

</body>
</html>
