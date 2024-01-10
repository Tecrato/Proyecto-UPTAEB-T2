import sys, ssl, smtplib, decouple
from email.message import EmailMessage

def main(args):
	email_sender = decouple.config('MAIL')
	email_reciver = args[1]
	texto = args[2]


	em = EmailMessage()
	em["from"] = email_reciver
	em["to"] = email_reciver
	em["subject"] = "Minimarket Variedades el Poly."
	em.set_content(texto)

	contexto = ssl.create_default_context()
	try:
		with smtplib.SMTP_SSL("smtp.gmail.com",465, context = contexto) as smtp:
			smtp.login(email_sender, decouple.config('MAIL_KEY'))
			smtp.sendmail(email_sender,email_reciver,em.as_string())
		return 'listo'
	except Exception as e:
		return 'fallo'



if __name__ == '__main__':
	'''
		Para hacer pruebas antes de llamarlo con PHP
	'''
	result = main(["jaja",decouple.config('MAIL_TEST'),"testo"])
else:
	result = main(list(sys.argv))

print(result,end="")