import smtplib
import ssl
from email.message import EmailMessage
import sys

email_sender = 'groupbarton56@gmail.com'
email_password = 'bqrqfbrrxxcfbtbg'
email_receiver = sys.argv[1]
subject = 'Recordatorio pago pendiente'
body = """
    Estimado(a) Cliente,

    Esperamos que se encuentre bien.
 
    Este es un recordatorio amigable de que tiene un pago pendiente en su cuenta con Barton Groups. Le animamos a realizar este pago a la mayor brevedad posible para evitar posibles inconvenientes.

    Si ya realizó este pago, por favor ignore este mensaje.

    Para cualquier consulta o aclaración, no dude en ponerse en contacto con nosotros.

    Agradecemos su atención y pronta respuesta.

    Atentamente,
    Equipo de Atención al Cliente
    Barton Groups
"""

em = EmailMessage()
em['From'] = email_sender
em['To'] = email_receiver
em['Subject'] = subject
em.set_content(body)

context = ssl.create_default_context()
with smtplib.SMTP_SSL('smtp.gmail.com', 465, context=context) as smtp:
    smtp.login(email_sender, email_password)
    smtp.sendmail(email_sender, email_receiver, em.as_string())