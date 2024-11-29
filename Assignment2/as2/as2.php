<?php
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
$response = file_get_contents($URL);

// Check if the request succeeded
if ($response === FALSE) {
    $results = null;
} else {
    // Decode the response
    $result = json_decode($response, true);
    $results = $result['results'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Statistics</title>
    <!-- Link to Pico CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.5.5/css/pico.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <h1>Student Statistics (from IT Colleges)</h1>
        <div class="table-container">
            <?php if (!empty($results)) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>College</th>
                            <th>Program</th>
                            <th>Nationality</th>
                            <th>Number of Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $record) : ?>
                            <tr>
                                <td><?= htmlspecialchars($record['year'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($record['semester'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($record['colleges'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($record['the_programs'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($record['nationality'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($record['number_of_students'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No data available to display.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
