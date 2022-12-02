#include "client.h"
#include "helper.h"

int main(int argc , char *argv[])
{
	char *HOST = argc > 1 ? argv[1] : "127.0.0.1";
	int PORT = argc > 2 ? atoi(argv[2]) : 65432;

	int socket = create_socket(HOST, PORT);
	int num_porte = 0, num_carte = 0;

	system("clear");
	printf("ceci n'est qu'une simulation de la carte de l'hotel.\n");

	while(true) {
		num_porte = ask_number("Veillez entrez le numéro de porte : ");
		num_carte = ask_number("Veillez entrez le numéro de carte : ");

		char message_to_send[10];
		char server_response;
		sprintf(message_to_send, "%d,%d", num_porte, num_carte);

		int res = send(socket, message_to_send, strlen(message_to_send), 0);
		if(res < 0)
		{
			printf("Send failed.\n");
			return 1;
		}

		res = read(socket, &server_response, 1);
		if(res < 0)
		{
			printf("Reading failed.\n");
			return 1;
		}

		printf("code recu : %c\n", server_response);

		switch (server_response)
		{
		case '0':
			printf("ouvrir la porte.\n");
			break;

		case '1':
			printf("carte inéxistance ou défaillante. Veillez contacter l'administration.\n");
			break;

		case '2':
			printf("porte inéxistante. Veillez contacter l'administration.\n");
			break;

		case '3':
			printf("carte perdue. -- Alerte la sécurité --\n");
			break;

		case '4':
			printf("vous n'avez pas accès.\n");
			break;
		
		default:
			printf("une erreur est survenue. Veillez contacter l'administration.\n");
			break;
		}
		printf("------------------------------------------------------------------------------\n");
	}

	return 0;
}