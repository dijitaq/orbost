<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
     <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
     <title>Orbost &amp; District Real Estate</title>
     <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
</head>

<body style="margin: 0; padding: 0;">
     <table>
          <tr>
               <td style="font-family: 'Roboto', sans-serif">Name :</td>
               <td style="font-family: 'Roboto', sans-serif">{{ $data['first_name'] }} {{ $data['last_name'] }}</td>
          </tr>

          <tr>
               <td style="font-family: 'Roboto', sans-serif">Email :</td>
               <td style="font-family: 'Roboto', sans-serif">{{ $data['email'] }}</td>
          </tr>

          <tr>
               <td style="font-family: 'Roboto', sans-serif">Phone :</td>
               <td style="font-family: 'Roboto', sans-serif">{{ $data['phone'] }}</td>
          </tr>

           <tr>
               <td style="font-family: 'Roboto', sans-serif">Address :</td>
               <td style="font-family: 'Roboto', sans-serif">{{ $data['address'] }}, {{ $data['suburb'] }}</td>
          </tr>
     </table>
</body>
</html>