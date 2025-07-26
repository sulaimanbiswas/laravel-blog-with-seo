<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color: #ffffff; border: 1px solid #dddddd; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">

                    <tr>
                        <td align="center" style="background-color: #03a87c; padding: 30px 20px; color: #ffffff;">
                            <h1 style="margin: 0; font-size: 24px;">{{ config('app.name') }}</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="font-size: 20px; color: #333333; margin: 0 0 20px 0;">You've received a new message from {{ config('app.name') }}:</h2>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                <tr>
                                    <td width="100" style="padding: 10px 0; font-weight: bold; color: #555555;">Name:</td>
                                    <td style="padding: 10px 0; color: #333333;">{{ $data['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; font-weight: bold; color: #555555;">Email:</td>
                                    <td style="padding: 10px 0; color: #333333;">{{ $data['email'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; font-weight: bold; color: #555555;">Subject:</td>
                                    <td style="padding: 10px 0; color: #333333;">{{ $data['subject'] }}</td>
                                </tr>
                            </table>

                            <hr style="border: 0; border-top: 1px solid #eeeeee; margin: 20px 0;">

                            <h3 style="font-size: 18px; color: #333333; margin: 0 0 10px 0;">Message Content:</h3>
                            <p style="margin: 0; color: #555555; line-height: 1.6;">
                                {{ $data['message'] }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #eeeeee; padding: 20px 30px; color: #888888; font-size: 12px;">
                            <p style="margin: 0;">This email was sent from the contact form on your website.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>