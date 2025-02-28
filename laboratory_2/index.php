<?php 
$dateOfWeek = (int) date("N");

$johnSchedule = match ($dateOfWeek) {
    1, 3, 5 => "8:00-12:00",
    default => "Нерабочий день",
};

$janeSchedule = match ($dateOfWeek) {
    2, 4, 6 => "12:00-16:00",
    default => "Нерабочий день",
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
</head>
<body>
    <table border="1" width="100%" cellspacing="0" cellpadding="4">
        <thead>
            <tr>
                <th>№</th>
                <th>Фамилия Имя</th>
                <th>График работы</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Styles</td>
                <td><?= $johnSchedule ?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Doe</td>
                <td><?= $janeSchedule ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>

