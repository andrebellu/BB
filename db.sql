DROP DATABASE IF EXISTS BB;

CREATE DATABASE IF NOT EXISTS BB;

USE BB;

CREATE TABLE Clienti (

Codice INTEGER AUTO_INCREMENT,

Cognome varCHAR(20) NOT NULL,

Nome varCHAR(20) NOT NULL,

Username varCHAR(20) NOT NULL,

Password varCHAR(100) NOT NULL,

Indirizzo varCHAR(60),

Telefono varCHAR(15) NOT NULL,

Email varCHAR(30),

Admin BIT DEFAULT 0,

PRIMARY KEY (Codice)
);

CREATE TABLE Camere (

Numero INTEGER,

Descrizione varCHAR(100),

Posti INTEGER NOT NULL,

Costo INTEGER NOT NULL,

PRIMARY KEY (Numero)

);

CREATE TABLE Prenotazioni (

id integer AUTO_INCREMENT,

Cliente integer,

Camera integer,

DataArrivo DATE,

DataPartenza DATE,

Disdetta BIT DEFAULT 0,

PRIMARY KEY (ID),

FOREIGN KEY (Cliente) REFERENCES Clienti(Codice),

FOREIGN KEY (Camera) REFERENCES Camere(Numero)

);

CREATE TABLE Soggiorni (

Prenotazione INTEGER,

Cliente INTEGER,

Document varCHAR(20),

PRIMARY KEY (Prenotazione, Cliente),

FOREIGN KEY (Cliente) REFERENCES Clienti(Codice),

FOREIGN KEY (Prenotazione) REFERENCES Prenotazioni(id)

);

INSERT INTO Clienti(Cognome, Nome, Indirizzo, Telefono, Email, Username, Password) VALUES ('Bottari', 'Barbara', 'Via Moretto 13', '123123123', 'barbara@bottari.it', 'barbarb', '007');

INSERT INTO Clienti(Cognome, Nome, Indirizzo, Telefono, Email, Username, Password) VALUES ('Tobia', 'Donato', 'Via del Risorgimento 12', '111222333', 'tobia@donato.it', 'tobid', '007');

INSERT INTO Clienti(Cognome, Nome, Indirizzo, Telefono, Email, Username, Password) VALUES ('Baudo', 'Giuseppe', 'Via del Mare 77', '6767676767', 'pippo@baudo.it', 'pippob', '007');

INSERT INTO Clienti(Cognome, Nome, Indirizzo, Telefono, Email, Username, Password) VALUES ('Rossi', 'Mario', 'Via del Mare 77', '6767676767', 'rossi@mario.com', 'rossim', '007');

INSERT INTO Camere(Numero, Descrizione, Posti, Costo) VALUES (1, 'Ciclamini', 3, 150), (2, 'Rose', 2, 100), (3, 'Girasoli', 4, 200), (4, 'Peonie', 2, 100), (5, 'Gardenie', 5, 250), (6, 'Tulipani', 3, 150);

INSERT INTO Prenotazioni(id, Cliente, Camera, DataArrivo, DataPartenza, Disdetta) VALUES (1, '1', 1, '2021-07-15', '2021-07-31', 0), (2, '2', 2, '2021-07-01', '2021-07-31', 0), (3, '3', 3, '2021-06-25', '2021-07-25', 0), (4, '3', 1, '2021-12-01', '2021-12-31', 0), (5, '4', 2, '2021-12-01', '2021-12-31', 0), (6, '3', 3, '2021-12-01', '2021-12-31', 0), (7, '1', 4, '2021-12-01', '2021-12-31', 0), (8, '2', 5, '2021-12-01', '2021-12-31', 0), (9, '4', 6, '2021-12-01', '2021-12-31', 0);

INSERT INTO Soggiorni(Prenotazione, Cliente, Document) VALUES (1, 1, 'CI'), (2,2, 'Patente'), (3, 1, 'CI'), (4, 3, 'Passaporto')