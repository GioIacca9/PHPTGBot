# PHPTGBot

**PHPTGBot** è una base scritta in **PHP** per semplificare la creazione di un Bot Telegram completo.

Con **PHPTGBot** è possibile utilizzare tutti i metodi presenti nelle [API di Telegram v4.5](https://core.telegram.org/bots/api) (ad esclusione dei metodi per [_Payments_](https://core.telegram.org/bots/api#payments), [_Telegram Passport_](https://core.telegram.org/bots/api#telegram-passport) e la piattaforma [_Games_](https://core.telegram.org/bots/api#games)).

---

## Requisiti

- PHP 5.6 o successivo (**7.3** raccomandato)
- Database MySQL
- Protocollo **HTTPS**
- Eventuali plugins potrebbero richiedere spazio su disco per funzionare correttamente
- È compatibile con Altervista.org

---

### Plugins
È possibile creare/importare plugins esterni per aggiungere funzionalità al Bot. Per aggiungere un plugin è necessario copiare i relativi file nella cartella **```plugins```** ed includere il loro nome nel file **```config.php```**. È possibile disabilitare temporaneamente un plugin installato impostando su ```false``` la relativa voce nel file **```config.php```**.

**Plugins Integrati:**
- **```Users```** permette agli amministratori di bandire/perdonare degli utenti dall'utilizzo del Bot facilmente.
-  **```Posts```** permette di inviare dei messaggi a tutti gli utenti iscritti al Bot con possibilità di scelta tra **_Tutti gli utenti_** o **_Solo utenti liberi_** (non banditi dal Bot)

---

## Configurazione

Avviare il Bot [@PHPTGSetupBot](https://t.me/PHPTGSetupBot) e seguire la configurazione guidata per creare un nuovo Bot e settare il relativo WebHook.

### ```config.php```

In questo file sono presenti tutte le impostazioni del Bot. Di seguito sono elencate le impostazioni principali del Bot.


|Nome Impostazione|Tipo|Descrizione| 
|:-:|:-:|:-|
|**```key```**|```string```|Chiave d'autenticazione del Bot. Viene generata da automaticamente [@PHPTGSetupBot](https://t.me/PHPTGSetupBot).|
|**```token```**|```string```|Token del Bot generato da [@BotFather](https://t.me/BotFather).|
|**```bot_username```**|```string```|L'username del Bot.|
|**```admins```**|Array di ```int```|Contiene gli **```user_id```** degli amministratori del Bot.|
<br>

---
<br>

### Comandi

Tutti i comandi del Bot dovranno essere creati nel file **```commands.php```**.
