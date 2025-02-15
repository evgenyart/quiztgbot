## Установка

1. git clone https://github.com/evgenyart/quiztgbot.git --branch=onsymfony ./
2. copy .env.example -> .env
3. Установить параметры MYSQL_ROOT_PASSWORD, MYSQL_PASSWORD (при необходимости, поментяь MYSQL_DATABASE, MYSQL_USER)
4. copy /app/.env.example -> /app/.env
5. Установить параметры TELEGRAM_BOT_TOKEN, TELEGRAM_BOT_LOGIN, API_TOKEN, DATABASE_URL
6. TELEGRAM_BOT_TOKEN можно получить после создания своего бота у @BotFather
7. Для приема веб-хуков от телеграмм, необходима доступность проекта из интернета и домен настроенным https сертификатом. 
Для теста я взял виртуальную машин у в таймвеб, там же сделал тестовый домен, на сервере установил ngnix, получил ssl-сертификат с помощью letsencrypt.
Nginx настроил в качестве прокси на nginx из докера, который на 8089 порту.
8. Необходимо настроить url для приема веб-хуков от бота, для этого в браузере подставить значение токена (TOKEN) и сайта (SITE) и перейти по ссылке
   https://api.telegram.org/botTOKEN/setWebhook?url=https://SITE/api/v1/hook
   в случае успеха будет сообщение:
   {"ok":true,"result":true,"description":"Webhook was set"}
9. На сервере должны быть установлены docker и docker-compose
10. В папке проекта выполнить docker-compose up -d
11. Найти бота по созданному логину и нажать "запустить". Далее можно ввести /help для получения списка возможных команд
12. Есть API методы для создания-получения списка игр, туров, вопросов
- GET-запрос /api/v1/games - получение списка игр, Тут и далее в заголовках необходимо передать в заголовках Authorization Bearer API_TOKEN
- POST-запрос /api/v1/game - создать игру, пример запроса с параметрами
  ```{
  "name": "Тестовая игра",
  "numTours": 1,
  "numQuestions": 1
  }``
- GET-запрос /api/v1/tours - получение списка туров
- POST-запрос /api/v1/tour - создать тур
- GET-запрос /api/v1/questions - вывести список вопросов из базы
- POST-запрос /api/v1/question - создать вопрос
13. Веб-хуки принимаются на адрес https://SITE/api/v1/hook, он работает без авторизации