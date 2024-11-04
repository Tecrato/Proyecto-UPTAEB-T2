import sys, smtplib, dotenv, os
from email.message import EmailMessage

def main(args):
	dotenv.load_dotenv()
	email_sender = os.environ['MAIL']
	email_reciver = args[1]
	texto = args[2]


	em = EmailMessage()
	em["from"] = email_sender
	em["to"] = email_reciver
	em["subject"] = "Minimarket Variedades el Poly."
	em.set_content(texto)

	# contexto = ssl.create_default_context()
	try:
		with smtplib.SMTP('smtp.gmail.com', 587) as smtp:
			smtp.ehlo()
			smtp.starttls()
			smtp.login(email_sender, os.environ['MAIL_KEY'])
			smtp.sendmail(email_sender,email_reciver,em.as_string())
		return 'listo'
	except Exception as e:
		return 'fallo'



if __name__ == '__main__':
	'''
		Para hacer pruebas antes de llamarlo con PHP
	'''
	result = main(list(sys.argv))
# 	result = main(["jeje",decouple.config('MAIL_TEST'),f"""
# 				<!DOCTYPE html>
# 				<html lang="es">
# 				<body>
# 				</body>
# 				</html>
# 				""",'12345'])
# else:

	print(result,end="")