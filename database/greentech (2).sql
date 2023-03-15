-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 02, 2023 alle 14:46
-- Versione del server: 5.7.17
-- Versione PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greentech`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `utente` varchar(50) NOT NULL,
  `quantita` int(11) NOT NULL,
  `prodotto` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`utente`, `quantita`, `prodotto`) VALUES
('user', 1, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `carta`
--

CREATE TABLE `carta` (
  `dataScadenza` date NOT NULL,
  `numero` varchar(16) NOT NULL,
  `titolare` varchar(30) NOT NULL,
  `cvv` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `comune`
--

CREATE TABLE `comune` (
  `istat` varchar(6) NOT NULL,
  `nomeComune` varchar(40) NOT NULL,
  `provincia` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `comune`
--

INSERT INTO `comune` (`istat`, `nomeComune`, `provincia`) VALUES
('027033', 'San Dona\' di Piave', 'Venezia'),
('027032', 'Salzano', 'Venezia'),
('027031', 'Quarto d\'Altino', 'Venezia'),
('027030', 'Pramaggiore', 'Venezia'),
('027029', 'Portogruaro', 'Venezia'),
('027028', 'Pianiga', 'Venezia'),
('027027', 'Noventa di Piave', 'Venezia'),
('027026', 'Noale', 'Venezia'),
('027025', 'Musile di Piave', 'Venezia'),
('027024', 'Mirano', 'Venezia'),
('027023', 'Mira', 'Venezia'),
('027022', 'Meolo', 'Venezia'),
('027020', 'Marcon', 'Venezia'),
('027021', 'Martellago', 'Venezia'),
('027019', 'Jesolo', 'Venezia'),
('027018', 'Gruaro', 'Venezia'),
('027017', 'Fosso\'', 'Venezia'),
('027016', 'Fossalta di Portogruaro', 'Venezia'),
('027015', 'Fossalta di Piave', 'Venezia'),
('027014', 'Fiesso d\'Artico', 'Venezia'),
('027013', 'Eraclea', 'Venezia'),
('027012', 'Dolo', 'Venezia'),
('027011', 'Concordia Sagittaria', 'Venezia'),
('027010', 'Cona', 'Venezia'),
('027009', 'Cinto Caomaggiore', 'Venezia'),
('027008', 'Chioggia', 'Venezia'),
('027007', 'Ceggia', 'Venezia'),
('027006', 'Cavarzere', 'Venezia'),
('027005', 'Caorle', 'Venezia'),
('027004', 'Camponogara', 'Venezia'),
('027003', 'Campolongo Maggiore', 'Venezia'),
('027002', 'Campagna Lupia', 'Venezia'),
('027001', 'Annone Veneto', 'Venezia'),
('026096', 'Pieve del Grappa', 'Treviso'),
('026095', 'Zero Branco', 'Treviso'),
('026094', 'Zenson di Piave', 'Treviso'),
('026093', 'Volpago del Montello', 'Treviso'),
('026092', 'Vittorio Veneto', 'Treviso'),
('026091', 'Villorba', 'Treviso'),
('026090', 'Vidor', 'Treviso'),
('026089', 'Vedelago', 'Treviso'),
('026088', 'Vazzola', 'Treviso'),
('026087', 'Valdobbiadene', 'Treviso'),
('026086', 'Treviso', 'Treviso'),
('026085', 'Trevignano', 'Treviso'),
('026084', 'Tarzo', 'Treviso'),
('026083', 'Susegana', 'Treviso'),
('026082', 'Spresiano', 'Treviso'),
('026081', 'Silea', 'Treviso'),
('026080', 'Sernaglia della Battaglia', 'Treviso'),
('026079', 'Segusino', 'Treviso'),
('026078', 'Sarmede', 'Treviso'),
('026077', 'San Zenone degli Ezzelini', 'Treviso'),
('026076', 'San Vendemiano', 'Treviso'),
('026075', 'Santa Lucia di Piave', 'Treviso'),
('026074', 'San Polo di Piave', 'Treviso'),
('026073', 'San Pietro di Feletto', 'Treviso'),
('026072', 'San Fior', 'Treviso'),
('026071', 'San Biagio di Callalta', 'Treviso'),
('026070', 'Salgareda', 'Treviso'),
('026069', 'Roncade', 'Treviso'),
('026068', 'Riese Pio X', 'Treviso'),
('026067', 'Revine Lago', 'Treviso'),
('026066', 'Resana', 'Treviso'),
('026065', 'Refrontolo', 'Treviso'),
('026064', 'Quinto di Treviso', 'Treviso'),
('026063', 'Preganziol', 'Treviso'),
('026062', 'Povegliano', 'Treviso'),
('026061', 'Possagno', 'Treviso'),
('026060', 'Portobuffole\'', 'Treviso'),
('026059', 'Ponzano Veneto', 'Treviso'),
('026058', 'Ponte di Piave', 'Treviso'),
('026057', 'Pieve di Soligo', 'Treviso'),
('026056', 'Pederobba', 'Treviso'),
('026055', 'Paese', 'Treviso'),
('026053', 'Orsago', 'Treviso'),
('026052', 'Ormelle', 'Treviso'),
('026051', 'Oderzo', 'Treviso'),
('026050', 'Nervesa della Battaglia', 'Treviso'),
('026049', 'Motta di Livenza', 'Treviso'),
('026048', 'Moriago della Battaglia', 'Treviso'),
('026047', 'Morgano', 'Treviso'),
('026046', 'Montebelluna', 'Treviso'),
('026045', 'Monfumo', 'Treviso'),
('026044', 'Monastier di Treviso', 'Treviso'),
('026043', 'Mogliano Veneto', 'Treviso'),
('026042', 'Miane', 'Treviso'),
('026041', 'Meduna di Livenza', 'Treviso'),
('026040', 'Maserada sul Piave', 'Treviso'),
('026039', 'Maser', 'Treviso'),
('026038', 'Mareno di Piave', 'Treviso'),
('026037', 'Mansue\'', 'Treviso'),
('026036', 'Loria', 'Treviso'),
('026035', 'Istrana', 'Treviso'),
('026034', 'Gorgo al Monticano', 'Treviso'),
('026033', 'Godega di Sant\'Urbano', 'Treviso'),
('026032', 'Giavera del Montello', 'Treviso'),
('026031', 'Gaiarine', 'Treviso'),
('026030', 'Fregona', 'Treviso'),
('026029', 'Fonte', 'Treviso'),
('026028', 'Fontanelle', 'Treviso'),
('026027', 'Follina', 'Treviso'),
('026026', 'Farra di Soligo', 'Treviso'),
('026025', 'Crocetta del Montello', 'Treviso'),
('026023', 'Cornuda', 'Treviso'),
('026022', 'Cordignano', 'Treviso'),
('026021', 'Conegliano', 'Treviso'),
('026020', 'Colle Umberto', 'Treviso'),
('026019', 'Codogne\'', 'Treviso'),
('026018', 'Cison di Valmarino', 'Treviso'),
('026017', 'Cimadolmo', 'Treviso'),
('026016', 'Chiarano', 'Treviso'),
('026015', 'Cessalto', 'Treviso'),
('026014', 'Cavaso del Tomba', 'Treviso'),
('026013', 'Castello di Godego', 'Treviso'),
('026012', 'Castelfranco Veneto', 'Treviso'),
('026011', 'Castelcucco', 'Treviso'),
('026010', 'Casier', 'Treviso'),
('026009', 'Casale sul Sile', 'Treviso'),
('026008', 'Carbonera', 'Treviso'),
('026007', 'Cappella Maggiore', 'Treviso'),
('026006', 'Caerano di San Marco', 'Treviso'),
('026005', 'Breda di Piave', 'Treviso'),
('026004', 'Borso del Grappa', 'Treviso'),
('026003', 'Asolo', 'Treviso'),
('026002', 'Arcade', 'Treviso'),
('026001', 'Altivole', 'Treviso'),
('025074', 'Borgo Valbelluna', 'Belluno'),
('025073', 'Val di Zoldo', 'Belluno'),
('025072', 'Alpago', 'Belluno'),
('025071', 'Longarone', 'Belluno'),
('025070', 'Quero Vas', 'Belluno'),
('025069', 'Zoppe\' di Cadore', 'Belluno'),
('025067', 'Voltago Agordino', 'Belluno'),
('025066', 'Vodo Cadore', 'Belluno'),
('025065', 'Vigo di Cadore', 'Belluno'),
('025063', 'Valle di Cadore', 'Belluno'),
('025062', 'Vallada Agordina', 'Belluno'),
('025060', 'Tambre', 'Belluno'),
('025059', 'Taibon Agordino', 'Belluno'),
('025058', 'Sovramonte', 'Belluno'),
('025057', 'Soverzene', 'Belluno'),
('025056', 'Sospirolo', 'Belluno'),
('025055', 'Seren del Grappa', 'Belluno'),
('025054', 'Selva di Cadore', 'Belluno'),
('025053', 'Sedico', 'Belluno'),
('025051', 'San Vito di Cadore', 'Belluno'),
('025050', 'Santo Stefano di Cadore', 'Belluno'),
('025049', 'San Tomaso Agordino', 'Belluno'),
('025048', 'Santa Giustina', 'Belluno'),
('025047', 'San Pietro di Cadore', 'Belluno'),
('025046', 'San Nicolo\' di Comelico', 'Belluno'),
('025045', 'San Gregorio nelle Alpi', 'Belluno'),
('025044', 'Rocca Pietore', 'Belluno'),
('025043', 'Rivamonte Agordino', 'Belluno'),
('025040', 'Ponte nelle Alpi', 'Belluno'),
('025039', 'Pieve di Cadore', 'Belluno'),
('025037', 'Perarolo di Cadore', 'Belluno'),
('025036', 'Pedavena', 'Belluno'),
('025035', 'Ospitale di Cadore', 'Belluno'),
('025033', 'Lozzo di Cadore', 'Belluno'),
('025032', 'Lorenzago di Cadore', 'Belluno'),
('025030', 'Livinallongo del Col di Lana', 'Belluno'),
('025029', 'Limana', 'Belluno'),
('025027', 'La Valle Agordina', 'Belluno'),
('025026', 'Lamon', 'Belluno'),
('025025', 'Gosaldo', 'Belluno'),
('025023', 'Canale d\'Agordo', 'Belluno'),
('025022', 'Fonzaso', 'Belluno'),
('025021', 'Feltre', 'Belluno'),
('025019', 'Falcade', 'Belluno'),
('025018', 'Domegge di Cadore', 'Belluno'),
('025017', 'Danta di Cadore', 'Belluno'),
('025016', 'Cortina d\'Ampezzo', 'Belluno'),
('025015', 'Comelico Superiore', 'Belluno'),
('025014', 'Colle Santa Lucia', 'Belluno'),
('025013', 'Cibiana di Cadore', 'Belluno'),
('025012', 'Chies d\'Alpago', 'Belluno'),
('025011', 'Cesiomaggiore', 'Belluno'),
('025010', 'Cencenighe Agordino', 'Belluno'),
('025008', 'Calalzo di Cadore', 'Belluno'),
('025007', 'Borca di Cadore', 'Belluno'),
('025006', 'Belluno', 'Belluno'),
('025005', 'Auronzo di Cadore', 'Belluno'),
('025004', 'Arsie\'', 'Belluno'),
('025003', 'Alleghe', 'Belluno'),
('025002', 'Alano di Piave', 'Belluno'),
('025001', 'Agordo', 'Belluno'),
('024127', 'Lusiana Conco', 'Vicenza'),
('024126', 'Colceresa', 'Vicenza'),
('024125', 'Valbrenta', 'Vicenza'),
('024124', 'Barbarano Mossano', 'Vicenza'),
('024123', 'Val Liona', 'Vicenza'),
('024122', 'Zugliano', 'Vicenza'),
('024121', 'Zovencedo', 'Vicenza'),
('024120', 'Zermeghedo', 'Vicenza'),
('024119', 'Zane\'', 'Vicenza'),
('024118', 'Villaverla', 'Vicenza'),
('024117', 'Villaga', 'Vicenza'),
('024116', 'Vicenza', 'Vicenza'),
('024115', 'Velo d\'Astico', 'Vicenza'),
('024113', 'Valli del Pasubio', 'Vicenza'),
('024112', 'Valdastico', 'Vicenza'),
('024111', 'Valdagno', 'Vicenza'),
('024110', 'Trissino', 'Vicenza'),
('024108', 'Torri di Quartesolo', 'Vicenza'),
('024107', 'Torrebelvicino', 'Vicenza'),
('024106', 'Tonezza del Cimone', 'Vicenza'),
('024105', 'Thiene', 'Vicenza'),
('024104', 'Tezze sul Brenta', 'Vicenza'),
('024103', 'Sovizzo', 'Vicenza'),
('024102', 'Sossano', 'Vicenza'),
('024101', 'Solagna', 'Vicenza'),
('024100', 'Schio', 'Vicenza'),
('024099', 'Schiavon', 'Vicenza'),
('024098', 'Sarego', 'Vicenza'),
('024097', 'Sarcedo', 'Vicenza'),
('024096', 'San Vito di Leguzzano', 'Vicenza'),
('024095', 'Santorso', 'Vicenza'),
('024094', 'San Pietro Mussolino', 'Vicenza'),
('024091', 'Sandrigo', 'Vicenza'),
('024090', 'Salcedo', 'Vicenza'),
('024089', 'Rotzo', 'Vicenza'),
('024088', 'Rossano Veneto', 'Vicenza'),
('024087', 'Rosa\'', 'Vicenza'),
('024086', 'Romano d\'Ezzelino', 'Vicenza'),
('024085', 'Roana', 'Vicenza'),
('024084', 'Recoaro Terme', 'Vicenza'),
('024083', 'Quinto Vicentino', 'Vicenza'),
('024082', 'Pozzoleone', 'Vicenza'),
('024081', 'Pove del Grappa', 'Vicenza'),
('024080', 'Posina', 'Vicenza'),
('024079', 'Pojana Maggiore', 'Vicenza'),
('024078', 'Piovene Rocchette', 'Vicenza'),
('024077', 'Pianezze', 'Vicenza'),
('024076', 'Pedemonte', 'Vicenza'),
('024075', 'Orgiano', 'Vicenza'),
('024074', 'Noventa Vicentina', 'Vicenza'),
('024073', 'Nove', 'Vicenza'),
('024072', 'Nogarole Vicentino', 'Vicenza'),
('024071', 'Nanto', 'Vicenza'),
('024070', 'Mussolente', 'Vicenza'),
('024068', 'Montorso Vicentino', 'Vicenza'),
('024067', 'Monticello Conte Otto', 'Vicenza'),
('024066', 'Monteviale', 'Vicenza'),
('024065', 'Montegaldella', 'Vicenza'),
('024064', 'Montegalda', 'Vicenza'),
('024063', 'Monte di Malo', 'Vicenza'),
('024062', 'Montecchio Precalcino', 'Vicenza'),
('024061', 'Montecchio Maggiore', 'Vicenza'),
('024060', 'Montebello Vicentino', 'Vicenza'),
('024057', 'Marostica', 'Vicenza'),
('024056', 'Marano Vicentino', 'Vicenza'),
('024055', 'Malo', 'Vicenza'),
('024053', 'Lugo di Vicenza', 'Vicenza'),
('024052', 'Lonigo', 'Vicenza'),
('024051', 'Longare', 'Vicenza'),
('024050', 'Lastebasse', 'Vicenza'),
('024049', 'Laghi', 'Vicenza'),
('024048', 'Isola Vicentina', 'Vicenza'),
('024047', 'Grumolo delle Abbadesse', 'Vicenza'),
('024046', 'Grisignano di Zocco', 'Vicenza'),
('024044', 'Gambugliano', 'Vicenza'),
('024043', 'Gambellara', 'Vicenza'),
('024042', 'Gallio', 'Vicenza'),
('024041', 'Foza', 'Vicenza'),
('024040', 'Fara Vicentino', 'Vicenza'),
('024039', 'Enego', 'Vicenza'),
('024038', 'Dueville', 'Vicenza'),
('024037', 'Crespadoro', 'Vicenza'),
('024036', 'Creazzo', 'Vicenza'),
('024035', 'Costabissara', 'Vicenza'),
('024034', 'Cornedo Vicentino', 'Vicenza'),
('024032', 'Cogollo del Cengio', 'Vicenza'),
('024030', 'Chiuppano', 'Vicenza'),
('024029', 'Chiampo', 'Vicenza'),
('024028', 'Castelgomberto', 'Vicenza'),
('024027', 'Castegnero', 'Vicenza'),
('024026', 'Cassola', 'Vicenza'),
('024025', 'Cartigliano', 'Vicenza'),
('024024', 'Carre\'', 'Vicenza'),
('024022', 'Campiglia dei Berici', 'Vicenza'),
('024021', 'Camisano Vicentino', 'Vicenza'),
('024020', 'Calvene', 'Vicenza'),
('024019', 'Caltrano', 'Vicenza'),
('024018', 'Caldogno', 'Vicenza'),
('024017', 'Brogliano', 'Vicenza'),
('024016', 'Bressanvido', 'Vicenza'),
('024015', 'Brendola', 'Vicenza'),
('024014', 'Breganze', 'Vicenza'),
('024013', 'Bolzano Vicentino', 'Vicenza'),
('024012', 'Bassano del Grappa', 'Vicenza'),
('024010', 'Asigliano Veneto', 'Vicenza'),
('024009', 'Asiago', 'Vicenza'),
('024008', 'Arzignano', 'Vicenza'),
('024007', 'Arsiero', 'Vicenza'),
('024006', 'Arcugnano', 'Vicenza'),
('024005', 'Altissimo', 'Vicenza'),
('024004', 'Altavilla Vicentina', 'Vicenza'),
('024003', 'Alonte', 'Vicenza'),
('024002', 'Albettone', 'Vicenza'),
('024001', 'Agugliaro', 'Vicenza'),
('023098', 'Zimella', 'Verona'),
('023097', 'Zevio', 'Verona'),
('023096', 'Villafranca di Verona', 'Verona'),
('023095', 'Villa Bartolomea', 'Verona'),
('023094', 'Vigasio', 'Verona'),
('023093', 'Vestenanova', 'Verona'),
('023092', 'Veronella', 'Verona'),
('023091', 'Verona', 'Verona'),
('023090', 'Velo Veronese', 'Verona'),
('023089', 'Valeggio sul Mincio', 'Verona'),
('023088', 'Trevenzuolo', 'Verona'),
('023087', 'Tregnago', 'Verona'),
('023086', 'Torri del Benaco', 'Verona'),
('023085', 'Terrazzo', 'Verona'),
('023084', 'Sorga\'', 'Verona'),
('023083', 'Sona', 'Verona'),
('023082', 'Sommacampagna', 'Verona'),
('023081', 'Soave', 'Verona'),
('023080', 'Selva di Progno', 'Verona'),
('023079', 'San Zeno di Montagna', 'Verona'),
('023078', 'Sant\'Anna d\'Alfaedo', 'Verona'),
('023077', 'Sant\'Ambrogio di Valpolicella', 'Verona'),
('023076', 'San Pietro in Cariano', 'Verona'),
('023075', 'San Pietro di Morubio', 'Verona'),
('023074', 'San Mauro di Saline', 'Verona'),
('023073', 'San Martino Buon Albergo', 'Verona'),
('023072', 'Sanguinetto', 'Verona'),
('023071', 'San Giovanni Lupatoto', 'Verona'),
('023070', 'San Giovanni Ilarione', 'Verona'),
('023069', 'San Bonifacio', 'Verona'),
('023068', 'Salizzole', 'Verona'),
('023067', 'Rovere\' Veronese', 'Verona'),
('023066', 'Roveredo di Gua\'', 'Verona'),
('023065', 'Roverchiara', 'Verona'),
('023064', 'Ronco all\'Adige', 'Verona'),
('023063', 'Ronca\'', 'Verona'),
('023062', 'Rivoli Veronese', 'Verona'),
('023061', 'Pressana', 'Verona'),
('023060', 'Povegliano Veronese', 'Verona'),
('023059', 'Peschiera del Garda', 'Verona'),
('023058', 'Pescantina', 'Verona'),
('023057', 'Pastrengo', 'Verona'),
('023056', 'Palu\'', 'Verona'),
('023055', 'Oppeano', 'Verona'),
('023054', 'Nogarole Rocca', 'Verona'),
('023053', 'Nogara', 'Verona'),
('023052', 'Negrar di Valpolicella ', 'Verona'),
('023051', 'Mozzecane', 'Verona'),
('023050', 'Monteforte d\'Alpone', 'Verona'),
('023049', 'Montecchia di Crosara', 'Verona'),
('023048', 'Minerbe', 'Verona'),
('023047', 'Mezzane di Sotto', 'Verona'),
('023046', 'Marano di Valpolicella', 'Verona'),
('023045', 'Malcesine', 'Verona'),
('023044', 'Legnago', 'Verona'),
('023043', 'Lazise', 'Verona'),
('023042', 'Lavagno', 'Verona'),
('023041', 'Isola Rizza', 'Verona'),
('023040', 'Isola della Scala', 'Verona'),
('023039', 'Illasi', 'Verona'),
('023038', 'Grezzana', 'Verona'),
('023037', 'Gazzo Veronese', 'Verona'),
('023036', 'Garda', 'Verona'),
('023035', 'Fumane', 'Verona'),
('023034', 'Ferrara di Monte Baldo', 'Verona'),
('023033', 'Erbezzo', 'Verona'),
('023032', 'Erbe\'', 'Verona'),
('023031', 'Dolce\'', 'Verona'),
('023030', 'Costermano sul Garda', 'Verona'),
('023029', 'Concamarise', 'Verona'),
('023028', 'Colognola ai Colli', 'Verona'),
('023027', 'Cologna Veneta', 'Verona'),
('023026', 'Cerro Veronese', 'Verona'),
('023025', 'Cerea', 'Verona'),
('023024', 'Cazzano di Tramigna', 'Verona'),
('023023', 'Cavaion Veronese', 'Verona'),
('023022', 'Castelnuovo del Garda', 'Verona'),
('023021', 'Castel d\'Azzano', 'Verona'),
('023020', 'Castagnaro', 'Verona'),
('023019', 'Casaleone', 'Verona'),
('023018', 'Caprino Veronese', 'Verona'),
('023017', 'Caldiero', 'Verona'),
('023016', 'Buttapietra', 'Verona'),
('023015', 'Bussolengo', 'Verona'),
('023014', 'Brenzone sul Garda', 'Verona'),
('023013', 'Brentino Belluno', 'Verona'),
('023012', 'Bovolone', 'Verona'),
('023011', 'Bosco Chiesanuova', 'Verona'),
('023010', 'Boschi Sant\'Anna', 'Verona'),
('023009', 'Bonavigo', 'Verona'),
('023008', 'Bevilacqua', 'Verona'),
('023007', 'Belfiore', 'Verona'),
('023006', 'Bardolino', 'Verona'),
('023005', 'Badia Calavena', 'Verona'),
('023004', 'Arcole', 'Verona'),
('023003', 'Angiari', 'Verona'),
('023002', 'Albaredo d\'Adige', 'Verona'),
('023001', 'Affi', 'Verona'),
('027034', 'San Michele al Tagliamento', 'Venezia'),
('027035', 'Santa Maria di Sala', 'Venezia'),
('027036', 'San Stino di Livenza', 'Venezia'),
('027037', 'Scorze\'', 'Venezia'),
('027038', 'Spinea', 'Venezia'),
('027039', 'Stra', 'Venezia'),
('027040', 'Teglio Veneto', 'Venezia'),
('027041', 'Torre di Mosto', 'Venezia'),
('027042', 'Venezia', 'Venezia'),
('027043', 'Vigonovo', 'Venezia'),
('027044', 'Cavallino-Treporti', 'Venezia'),
('028001', 'Abano Terme', 'Padova'),
('028002', 'Agna', 'Padova'),
('028003', 'Albignasego', 'Padova'),
('028004', 'Anguillara Veneta', 'Padova'),
('028005', 'Arqua\' Petrarca', 'Padova'),
('028006', 'Arre', 'Padova'),
('028007', 'Arzergrande', 'Padova'),
('028008', 'Bagnoli di Sopra', 'Padova'),
('028009', 'Baone', 'Padova'),
('028010', 'Barbona', 'Padova'),
('028011', 'Battaglia Terme', 'Padova'),
('028012', 'Boara Pisani', 'Padova'),
('028013', 'Borgoricco', 'Padova'),
('028014', 'Bovolenta', 'Padova'),
('028015', 'Brugine', 'Padova'),
('028016', 'Cadoneghe', 'Padova'),
('028017', 'Campodarsego', 'Padova'),
('028018', 'Campodoro', 'Padova'),
('028019', 'Camposampiero', 'Padova'),
('028020', 'Campo San Martino', 'Padova'),
('028021', 'Candiana', 'Padova'),
('028022', 'Carceri', 'Padova'),
('028023', 'Carmignano di Brenta', 'Padova'),
('028026', 'Cartura', 'Padova'),
('028027', 'Casale di Scodosia', 'Padova'),
('028028', 'Casalserugo', 'Padova'),
('028029', 'Castelbaldo', 'Padova'),
('028030', 'Cervarese Santa Croce', 'Padova'),
('028031', 'Cinto Euganeo', 'Padova'),
('028032', 'Cittadella', 'Padova'),
('028033', 'Codevigo', 'Padova'),
('028034', 'Conselve', 'Padova'),
('028035', 'Correzzola', 'Padova'),
('028036', 'Curtarolo', 'Padova'),
('028037', 'Este', 'Padova'),
('028038', 'Fontaniva', 'Padova'),
('028039', 'Galliera Veneta', 'Padova'),
('028040', 'Galzignano Terme', 'Padova'),
('028041', 'Gazzo', 'Padova'),
('028042', 'Grantorto', 'Padova'),
('028043', 'Granze', 'Padova'),
('028044', 'Legnaro', 'Padova'),
('028045', 'Limena', 'Padova'),
('028046', 'Loreggia', 'Padova'),
('028047', 'Lozzo Atestino', 'Padova'),
('028048', 'Masera\' di Padova', 'Padova'),
('028049', 'Masi', 'Padova'),
('028050', 'Massanzago', 'Padova'),
('028052', 'Megliadino San Vitale', 'Padova'),
('028053', 'Merlara', 'Padova'),
('028054', 'Mestrino', 'Padova'),
('028055', 'Monselice', 'Padova'),
('028056', 'Montagnana', 'Padova'),
('028057', 'Montegrotto Terme', 'Padova'),
('028058', 'Noventa Padovana', 'Padova'),
('028059', 'Ospedaletto Euganeo', 'Padova'),
('028060', 'Padova', 'Padova'),
('028061', 'Pernumia', 'Padova'),
('028062', 'Piacenza d\'Adige', 'Padova'),
('028063', 'Piazzola sul Brenta', 'Padova'),
('028064', 'Piombino Dese', 'Padova'),
('028065', 'Piove di Sacco', 'Padova'),
('028066', 'Polverara', 'Padova'),
('028067', 'Ponso', 'Padova'),
('028068', 'Pontelongo', 'Padova'),
('028069', 'Ponte San Nicolo\'', 'Padova'),
('028070', 'Pozzonovo', 'Padova'),
('028071', 'Rovolon', 'Padova'),
('028072', 'Rubano', 'Padova'),
('028073', 'Saccolongo', 'Padova'),
('028075', 'San Giorgio delle Pertiche', 'Padova'),
('028076', 'San Giorgio in Bosco', 'Padova'),
('028077', 'San Martino di Lupari', 'Padova'),
('028078', 'San Pietro in Gu', 'Padova'),
('028079', 'San Pietro Viminario', 'Padova'),
('028080', 'Santa Giustina in Colle', 'Padova'),
('028082', 'Sant\'Angelo di Piove di Sacco', 'Padova'),
('028083', 'Sant\'Elena', 'Padova'),
('028084', 'Sant\'Urbano', 'Padova'),
('028085', 'Saonara', 'Padova'),
('028086', 'Selvazzano Dentro', 'Padova'),
('028087', 'Solesino', 'Padova'),
('028088', 'Stanghella', 'Padova'),
('028089', 'Teolo', 'Padova'),
('028090', 'Terrassa Padovana', 'Padova'),
('028091', 'Tombolo', 'Padova'),
('028092', 'Torreglia', 'Padova'),
('028093', 'Trebaseleghe', 'Padova'),
('028094', 'Tribano', 'Padova'),
('028095', 'Urbana', 'Padova'),
('028096', 'Veggiano', 'Padova'),
('028097', 'Vescovana', 'Padova'),
('028098', 'Vighizzolo d\'Este', 'Padova'),
('028099', 'Vigodarzere', 'Padova'),
('028100', 'Vigonza', 'Padova'),
('028101', 'Villa del Conte', 'Padova'),
('028102', 'Villa Estense', 'Padova'),
('028103', 'Villafranca Padovana', 'Padova'),
('028104', 'Villanova di Camposampiero', 'Padova'),
('028105', 'Vo\'', 'Padova'),
('028106', 'Due Carrare', 'Padova'),
('028107', 'Borgo Veneto', 'Padova'),
('029001', 'Adria', 'Rovigo'),
('029002', 'Ariano nel Polesine', 'Rovigo'),
('029003', 'Arqua\' Polesine', 'Rovigo'),
('029004', 'Badia Polesine', 'Rovigo'),
('029005', 'Bagnolo di Po', 'Rovigo'),
('029006', 'Bergantino', 'Rovigo'),
('029007', 'Bosaro', 'Rovigo'),
('029008', 'Calto', 'Rovigo'),
('029009', 'Canaro', 'Rovigo'),
('029010', 'Canda', 'Rovigo'),
('029011', 'Castelguglielmo', 'Rovigo'),
('029012', 'Castelmassa', 'Rovigo'),
('029013', 'Castelnovo Bariano', 'Rovigo'),
('029014', 'Ceneselli', 'Rovigo'),
('029015', 'Ceregnano', 'Rovigo'),
('029017', 'Corbola', 'Rovigo'),
('029018', 'Costa di Rovigo', 'Rovigo'),
('029019', 'Crespino', 'Rovigo'),
('029021', 'Ficarolo', 'Rovigo'),
('029022', 'Fiesso Umbertiano', 'Rovigo'),
('029023', 'Frassinelle Polesine', 'Rovigo'),
('029024', 'Fratta Polesine', 'Rovigo'),
('029025', 'Gaiba', 'Rovigo'),
('029026', 'Gavello', 'Rovigo'),
('029027', 'Giacciano con Baruchella', 'Rovigo'),
('029028', 'Guarda Veneta', 'Rovigo'),
('029029', 'Lendinara', 'Rovigo'),
('029030', 'Loreo', 'Rovigo'),
('029031', 'Lusia', 'Rovigo'),
('029032', 'Melara', 'Rovigo'),
('029033', 'Occhiobello', 'Rovigo'),
('029034', 'Papozze', 'Rovigo'),
('029035', 'Pettorazza Grimani', 'Rovigo'),
('029036', 'Pincara', 'Rovigo'),
('029037', 'Polesella', 'Rovigo'),
('029038', 'Pontecchio Polesine', 'Rovigo'),
('029039', 'Porto Tolle', 'Rovigo'),
('029040', 'Rosolina', 'Rovigo'),
('029041', 'Rovigo', 'Rovigo'),
('029042', 'Salara', 'Rovigo'),
('029043', 'San Bellino', 'Rovigo'),
('029044', 'San Martino di Venezze', 'Rovigo'),
('029045', 'Stienta', 'Rovigo'),
('029046', 'Taglio di Po', 'Rovigo'),
('029047', 'Trecenta', 'Rovigo'),
('029048', 'Villadose', 'Rovigo'),
('029049', 'Villamarzana', 'Rovigo'),
('029050', 'Villanova del Ghebbo', 'Rovigo'),
('029051', 'Villanova Marchesana', 'Rovigo'),
('029052', 'Porto Viro', 'Rovigo');

-- --------------------------------------------------------

--
-- Struttura della tabella `contiene`
--

CREATE TABLE `contiene` (
  `quantita` smallint(6) NOT NULL,
  `idProdotto` int(11) NOT NULL,
  `numberTracking` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `contiene`
--

INSERT INTO `contiene` (`quantita`, `idProdotto`, `numberTracking`) VALUES
(1, 3, 129),
(1, 2, 129);

-- --------------------------------------------------------

--
-- Struttura della tabella `datipagamento`
--

CREATE TABLE `datipagamento` (
  `ordineTracking` int(11) NOT NULL,
  `cvv` varchar(3) DEFAULT NULL,
  `numero` varchar(16) DEFAULT NULL,
  `titolare` varchar(30) DEFAULT NULL,
  `dataScadenza` date DEFAULT NULL,
  `metodoPagamento` enum('prepagata','contrassegno') DEFAULT 'prepagata'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `datipagamento`
--

INSERT INTO `datipagamento` (`ordineTracking`, `cvv`, `numero`, `titolare`, `dataScadenza`, `metodoPagamento`) VALUES
(129, '881', '4790452942547', 'Ombretta Gaggi', '2028-02-00', 'prepagata'),
(121, NULL, NULL, NULL, NULL, 'contrassegno'),
(122, NULL, NULL, NULL, NULL, 'contrassegno'),
(124, '881', '4691711222506246', 'Yuri Lovato', '2023-12-07', 'prepagata'),
(125, NULL, NULL, NULL, NULL, 'contrassegno'),
(126, '855', '4216894753158964', 'busatta laura', '2028-02-01', 'prepagata'),
(127, '881', '4691711222506246', 'Yuri Lovato', '2023-12-07', 'prepagata'),
(128, NULL, NULL, NULL, NULL, 'contrassegno');

-- --------------------------------------------------------

--
-- Struttura della tabella `datispedizione`
--

CREATE TABLE `datispedizione` (
  `ordineTracking` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `via` varchar(30) NOT NULL,
  `civico` varchar(6) NOT NULL,
  `cap` varchar(10) NOT NULL,
  `comune` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `datispedizione`
--

INSERT INTO `datispedizione` (`ordineTracking`, `nome`, `cognome`, `via`, `civico`, `cap`, `comune`) VALUES
(129, 'ombretta', 'gaggi', 'Via luzzati', '38', '35100', '028060');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `data` date NOT NULL,
  `totale` smallint(6) NOT NULL,
  `numberTracking` int(11) NOT NULL,
  `utente` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`data`, `totale`, `numberTracking`, `utente`) VALUES
('2023-02-02', 370, 129, 'user');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `id` int(11) NOT NULL,
  `costo` smallint(6) NOT NULL,
  `modello` varchar(20) NOT NULL,
  `immagine` varchar(50) DEFAULT NULL,
  `descrizione` varchar(300) NOT NULL,
  `categoria` enum('rilevatore indoor','rilevatore outdoor','purificatore indoor','filtro') NOT NULL,
  `alt` varchar(65) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`id`, `costo`, `modello`, `immagine`, `descrizione`, `categoria`, `alt`) VALUES
(1, 400, 'ms-500', '../Immagini/prodotti/rilevatore_outdoor4.jpg', 'Il nostro rilevatore outdoor di eccellenza , ms-500 e\' adatto per rilevazioni di massima precisione . Il suo rivestimento in alluminio gli permette di resistere a qualsiasi condizione atmosferica', 'rilevatore outdoor', 'Due scatole cilindriche di colore bianco'),
(2, 250, 'ms-300', '../Immagini/prodotti/rilevatore_outdoor3.jpg', 'Il fratello piu\' piccolo di ms-500 e\' il rilevatore ms-300 , piccolo ma preciso e\' adatto per essere collocato nel giardino di casa . Rimani sempre aggiornato , anche a casa , della qualita\' dell\'aria che stai respirando', 'rilevatore outdoor', 'Scatola di piccole dimensioni ,colore bianco'),
(3, 120, 'Home ms-100', '../Immagini/prodotti/rilevatore_indoor1.jpg', 'Piccolo e pratico , home ms-100 e\' la soluzione ideale per la tua casa . Tramite un pannello integrato e\' capace di visualizzare in tempo reale i parametri inquinanti grazie ai suoi 8 canali per la rilevazione della qualita\' dell\'aria', 'rilevatore indoor', 'Scatola di piccole dimensioni di colore bianco dotato di display'),
(4, 110, 'fms-500', '../Immagini/prodotti/filtro1.jpeg', 'Piu\' piccolo di Home purificator, ma non meno potente , fms-500 e\' il purificatore piu\' venduto . Gradito da tutti i casalinghi e\' in grado di ridurre fino al 50% l\'inquinamento dall\'aria che stai respirando ', 'purificatore indoor', 'Scatola cilindrica , bianco , di piccole dimensioni'),
(5, 80, 'fms-300', '../Immagini/prodotti/filtro2.jpeg', 'Il nostro purificatore piu\' piccolo per gli amanti del minimal. Fms-300 e\' in grado di ridurre fino al 40% l\'inquinamento dall\'aria che stai respirando . Se quello che stai cercando e\' un purificatore efficace e di piccole dimensioni , fms-300 e\' la soluzione ideale', 'purificatore indoor', 'Scatola quadrata , di colore bianco , di piccole dimensioni'),
(6, 100, 'Home purificator', '../Immagini/prodotti/purificatore_aria1.jpg', 'Sei stanco di respirare aria inquinata ? Home purificator puo\' eliminare fino al 80% l\'inquinamento dall\'aria che stai respirando , elegante e di piccole dimensioni e\' la soluzione per la tua casa piu\' green', 'purificatore indoor', 'Scatola cilindrica , bianca , di piccole dimensioni');

-- --------------------------------------------------------

--
-- Struttura della tabella `registra`
--

CREATE TABLE `registra` (
  `utente` varchar(50) NOT NULL,
  `carta` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `dataNascita` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `civico` varchar(6) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `cap` varchar(10) NOT NULL,
  `via` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `comune` varchar(6) NOT NULL,
  `cf` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`dataNascita`, `email`, `civico`, `nome`, `cognome`, `cap`, `via`, `password`, `comune`, `cf`) VALUES
('1975-10-10', 'user', '61', 'ombretta', 'gaggi', '31033', 'Via San Marco', '$2y$10$mD3jV9H/WUTJjg8ksj7MDexPeIZ0PBoRbdT8bBSe4MgkREHU61Ex6', '026012', 'GGGMRT75R50C111K');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`utente`,`prodotto`),
  ADD KEY `prodotto` (`prodotto`);

--
-- Indici per le tabelle `carta`
--
ALTER TABLE `carta`
  ADD PRIMARY KEY (`numero`);

--
-- Indici per le tabelle `comune`
--
ALTER TABLE `comune`
  ADD PRIMARY KEY (`istat`),
  ADD KEY `istat` (`istat`);

--
-- Indici per le tabelle `contiene`
--
ALTER TABLE `contiene`
  ADD PRIMARY KEY (`idProdotto`,`numberTracking`),
  ADD KEY `ordineProdotto` (`numberTracking`);

--
-- Indici per le tabelle `datipagamento`
--
ALTER TABLE `datipagamento`
  ADD PRIMARY KEY (`ordineTracking`);

--
-- Indici per le tabelle `datispedizione`
--
ALTER TABLE `datispedizione`
  ADD PRIMARY KEY (`ordineTracking`),
  ADD KEY `comune` (`comune`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`numberTracking`),
  ADD KEY `utente` (`utente`),
  ADD KEY `numeber_tracking` (`numberTracking`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `registra`
--
ALTER TABLE `registra`
  ADD PRIMARY KEY (`utente`,`carta`),
  ADD KEY `carta` (`carta`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`email`),
  ADD KEY `comune` (`comune`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `numberTracking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
