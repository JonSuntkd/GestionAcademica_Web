<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<form name="newForm" method="post" action="sample.php">
		<table>
			<?php	
				for ($i=1; $i<=9; $i++) {
					print("<tr>");
					for ($j=1; $j<=9; $j++) {
						print("<td><input type=\\'text\\' class=\\'contents\\' name=\\'contents[[$i][$j]]\\' /></td>");	
					}						
				        print("</tr>");
				}
			?>
			</table>
			<input type="submit" name="submit" value="Enter Game Values" id="submit" />
		</form>	
</body>
</html>