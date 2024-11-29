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
    <style>
        /* Table Wrapper with Scroll */
        .table-container {
            max-height: 750px; /* Set a fixed height for scrolling */
            overflow-y: auto; /* Enable vertical scrolling */
            overflow-x: auto; /* Enable horizontal scrolling for small screens */
            border: 1px solid #ddd; /* Add a border to define the container */
            border-radius: 8px; /* Rounded corners for a polished look */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add subtle shadow for visibility */
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff; /* Ensure a white background */
        }

        /* Header Styling */
        thead {
            background-color: #f4f4f4; /* Light gray background for the header */
            position: sticky; /* Sticky header for scrolling */
            top: 0;
            z-index: 10; /* Ensure it stays above other elements */
        }

        th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-weight: bold;
            color: #333333; /* Dark text for contrast */
            border-bottom: 1px solid #ddd; /* Subtle border below header */
        }

        /* Row Styling */
        tbody tr {
            transition: background-color 0.2s ease; /* Smooth hover effect */
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Zebra striping for alternate rows */
        }

        tbody tr:hover {
            background-color: #e2e6ea; /* Slightly darker shade for hover */
        }

        td {
            text-align: left;
            padding: 0.75rem 1rem;
            color: #555555; /* Medium-dark text for body */
            word-wrap: break-word; /* Prevent overflow in smaller screens */
        }

        /* Mobile Friendly Adjustments */
        @media (max-width: 600px) {
            th, td {
                padding: 0.5rem; /* Reduce padding for smaller screens */
                font-size: 0.9rem; /* Slightly smaller font size */
            }
        }
    </style>
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
