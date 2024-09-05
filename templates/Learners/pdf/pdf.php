<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transcript</title>
    <style>
        body {
            font-family: "Courier New", monospace;
            margin: 0px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        th, td {
            border: 0px solid #ccc;
            padding: 2px;
            text-align: left;
            vertical-align: top;
        }

        .table-fixed-width {
            width: 100%;
        }

        .table-fixed-width td {
            width: 50%;
        }

        p {
            margin: 0;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 10rem;
            color: #d0d0d0;
            opacity: 0.3;
            z-index: -1;
        }
        .disclaimer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #f2f2f2;
            padding: 10px;
            font-size: 0.8rem;
            text-align: center;
            box-sizing: border-box;
        }
        .footer {
            position: absolute;
            bottom: 35px; /* Adjust the distance from the bottom as needed */
            width: 100%;
            text-align: center;
        }

        .signature-box {
            position: relative;
        }

        .signature-line {
            width: 100%;
            height: 1px;
            background-color: #000;
            margin-bottom: 5px;
        }

        .signature-label {
            text-align: center;
            font-size: 12px;
            color: #000;
            margin: 0;
        }

        .watermark-sig {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            opacity: 0.1;
        }


    </style>
</head>
<body>
<div class="watermark">Unofficial</div>
<h1>Academic Transcript</h1>

<table class="table-fixed-width">
    <tr>
        <td style="width: 40%;">
            <p><strong><?php echo $learner->first_name ?> <?php echo $learner->last_name ?></strong></p>
            <p><?php echo $learner->user->address_line_1 ?></p>
            <p><?php echo $learner->user->address_line_2 ?></p>
            <p><?php echo $learner->user->address_city ?>, <?php echo $learner->user->address_state ?> <?php echo $learner->user->address_zip ?></p>
        </td>
        <td style="width: 60%;">
            <p><strong>Institution:</strong> <?php echo $learner->user->institution_name ?></p>
            <p><strong>Administrator:</strong> <?php echo $learner->user->first_name ?> <?php echo $learner->user->last_name ?></p>
            <p><strong>Phone:</strong> <?php echo $learner->user->phone ?></p>
        </td>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th>Academic Year</th>
        <th>Subject</th>
        <th>Course Title</th>
        <th>Credit Hours</th>
        <th>Grade</th>
    </tr>
    </thead>
    <tbody>
    <!-- Add more rows as needed -->
    <?php foreach ($learner->courses as $course) : ?>
    <tr>
        <td><?= h($course->school_year->name) ?></td>
        <td><?= h($course->subject->name) ?></td>
        <td><?= h($course->name) ?></td>
        <td><?= h($course->credits) ?></td>
        <td><?= h($course->grade->name) ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="footer">
    <table class="table-fixed-width">
        <tr>
            <td>
                <p><strong>GPA:</strong> <?= h(number_format($gpa, 1)) ?></p>
                <p><strong>Graduation Date:</strong> <?php if ($learner->graduation_date !== null) {
                        echo $learner->graduation_date->format('m/d/y');
                    } else {
                        echo 'Not Entered';
                    }
                    ?></p>
            </td>
            <td>
                <div class="signature-box">
                    <img src="#" class="watermark-sig" alt="Watermark Logo">
                    <div class="signature-line"></div>
                    <p class="signature-label"><strong><?php echo $learner->user->first_name ?> <?php echo $learner->user->last_name ?></strong>, Administrator</p>
                </div>
            </td>
        </tr>
    </table>
</div>


<div class="disclaimer">
    This transcript is provided for informational purposes only and is not an official document. Please contact the Registrar's Office for official transcripts.
</div>

</body>
</html>
