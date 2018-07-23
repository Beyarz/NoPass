<?php
/**
 * Created by PhpStorm.
 * User: Beyarz
 * Date: 2018-05-24
 * Time: 00:55
 */

session_start();

include("config.php");
$uid = $_COOKIE["uid"];
$publicip = $_COOKIE["publicip"];
$useragent = str_replace(" ", "_", $_COOKIE["useragent"]);

$source = "#include <stdio.h> /* Printf() & Sprintf() */
#include <sys/socket.h> /* Socket() & connect() */
#include <netdb.h> /* Struct hostent & gethostname() */
#include <netinet/in.h> /* Struct sockaddr_in & serv_addr */
#include <string.h> /* Memset() */
#include <unistd.h> /* Read(), write() & close() */
#include <stdlib.h> /* Exit() */
#include <sys/utsname.h> /* Struct utsname */

int main() {
	
	/* Defined pointers */
	printf(\"[+] Defining process details.\");
	printf(\"\\n\");
	char *port = \"$port\";
	char *host = \"$domain\";
	char *path = \"$path\";
	char *rawheader = \"GET %s?&uid=$uid&hostname=%s&publicip=$publicip&os=%s&useragent=$useragent HTTP/1.1\\r\\nHost: %s\\r\\nContent-type: application/x-www-form-urlencoded\\r\\n\\r\\n\";
	
	/* Getting hostname */
	char hostname[64];
    gethostname(hostname, 64);
	
	/* Getting os name */
	struct utsname name;
	uname(&name);
	char *os = name.sysname;
	
	// Fail checking
	if(strlen(host) == 0){
		//puts(\"Host not defined.\");
		return 1;
	} else if(strlen(port) == 0){
		//puts(\"Port not defined.\");
		return 1;
	} else if(strlen(path)){
		// Requests without path is fine
		//puts(\"Path not defined, continuing...\");
	} else if(strlen(rawheader)){
		//puts(\"Headers not defined.\");
		return 1;
	}
	
	printf(\"[+] Creating buffer.\");
	printf(\"\\n\");
	// Initializing before usage
	char header[512];
	char buffer[4096];
	int sockfd;
	int byte_count;
	
	/* Structure
	 * \"hints is an optional pointer to a struct addrinfo\" - FreeBSD
	 */
	struct addrinfo hints, *res;
	
	// Creating socket
	printf(\"[+] Creating socket.\");
	printf(\"\\n\");
	memset(&hints, 0, sizeof(hints));
	hints.ai_family = AF_INET;
	hints.ai_protocol = 0;
	hints.ai_socktype = SOCK_STREAM;
	
	// Opening socket
	printf(\"[+] Sending request.\");
	printf(\"\\n\");
	getaddrinfo(host, port, &hints, &res);
	sockfd = socket(res->ai_family, res->ai_socktype, res->ai_protocol);
	
	// Connectes
	printf(\"[!] Connected.\");
	printf(\"\\n\");
	connect(sockfd, res->ai_addr, res->ai_addrlen);
	
	// Sending request
	printf(\"[+] Packet sent.\");
	printf(\"\\n\");
	sprintf(header, rawheader, path, hostname, os, host);
	send(sockfd, header, strlen(header), 0);
	
	// Receives data
	byte_count = recv(sockfd, buffer, sizeof(buffer), 0);
	
	// Returns data
	//printf(\"Received %d bytes of data in buffer\\n\\n\" ,byte_count);
	//printf(\"%s\\n\", buffer);
	
	printf(\"[!] Handshake finished.\");
	printf(\"\\n\");
	printf(\"[!] You can now update the page.\");
	printf(\"\\n\");
	puts(\"Press any key to exit.\");
	getchar();
	system(\"exit\");
	system(\"rm ".$filename."-".$uid."\");
	
	/* Shows the program runned successfully */
	return 0;

}";

$newfile = fopen($filename."-".$uid.".c", "w");
fwrite($newfile, $source);
fclose($newfile);
exec("gcc ".$filename."-".$uid.".c -o ".$filename."-".$uid);
exec("zip ".$filename."-".$uid.".zip ".$filename."-".$uid);
header("Location: ".$filename."-".$uid.".zip");

?>