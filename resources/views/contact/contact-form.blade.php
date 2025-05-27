<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nieuw Contactbericht</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2563eb;">Nieuw Contactbericht</h2>
        
        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <p><strong>Van:</strong> {{ $contactMessage->name }}</p>
            <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
            <p><strong>Onderwerp:</strong> {{ $contactMessage->subject }}</p>
            <p><strong>Datum:</strong> {{ $contactMessage->created_at->format('d-m-Y H:i') }}</p>
        </div>

        <div style="background-color: #ffffff; padding: 20px; border: 1px solid #e5e5e5; border-radius: 5px;">
            <h3>Bericht:</h3>
            <p style="white-space: pre-wrap;">{{ $contactMessage->message }}</p>
        </div>

        <div style="margin-top: 20px; padding: 15px; background-color: #e7f3ff; border-radius: 5px;">
            <p style="margin: 0;"><strong>Je kunt direct antwoorden op:</strong> {{ $contactMessage->email }}</p>
        </div>
    </div>
</body>
</html>