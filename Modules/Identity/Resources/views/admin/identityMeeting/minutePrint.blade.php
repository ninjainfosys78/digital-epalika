<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            border-radius: 5px;
        }

        @media print {
            @page {
                size: A4 portrait;
            }

            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
{!! $identityMeeting->minute !!}
</body>
</html>
