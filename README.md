## O projekcie
Stworzyłem bardzo prosty cms, który pozwala na dodawanie i wyświetlanie artykułów, które uprzedmio muszą być zaakceptowane przez admina.

## Co potrafi Simple CMS? 
1. Posiada dwie wersje językowe - polską i angielską. Każdy użytkownik może sobie wybrać wersję językową w menu na górze strony. Panel administracyjny jest zawsze w j. angielskim.
2. Tworzenie nowych artykułów - każdy user może stworzyć własny artykuł `panel/article/create`, jednak nie zostanie on wyświetlony, jeśli nie zaakceptuje go admin `admin/articles/all`. Przy tworzeniu artykułu należy wskazać  kategorię (na  chwilę obecną nie ma formularza do tworzenia kategorii, ale można je stworzyć w odpowiednim seederze - `CategorySeeder`). Dodanie okładni jest dobrowolne. Jeśli nie żaden plik nie zostanie załączony, simple cms wyświewtli okładkę domyślną.
3. Admin może akceptować i usuwać artykuły `admin/articles/all`.
4. Admin może usuwać użytkowników, albo zmieniach ich dane, np. hasła, adresy email, itp `admin/users/all`.
5. Admin może tworzyć nowych użytkowników `admin/users/create`.
6. Można wysyłać maile do odpowiednich działów, korzystając z dostępnego dla wszystkich (także dla gości) formularza `contact`. W celu przetestowania poprawności wysyłania maili, pronouję skorzystać z MailHog `localhost:8025/`.

## Ustępstwa
Nie starałem się tworzyć kodu produkcyjnego, a jedynie pokazać, że znam PHP. Pracuję zawodowo i mam inne obowiązku, więc chciałem po prostu stworzyć kod pokazujący moje umiejętności, a nie kod, który będzie używany przez kogokolwiek. Dlatego projekt musiał zawierać pewne ustępstwa.

1. Nie pokryłem całem projektu testami. W zasadzie stworzyłem tylko kilka. W kodzie produkcyjnym oczywiście nie byłoby to odpowiednie, ale w tym miejscu chciałem zaznaczyć, że testy są dla mnie ważne, potrafię je tworzyć, ale skupiłem się w tym projekcie bardziej na stworzeniu konkretnych funkcjonalności.
2. Zrezygnowałem z Vite. Tutaj skupiałem się wyłącznie na backendzie, więc Vite nie było mi potrzebne.
3. Skupiłem się na backendzie. Frontend nie był dla mnie istotny. Oczyście - gdybym tworzył kod produkcyjny, zapewno wydzieliłbym konkretne elementy interfejsu, do osobnych plików (np. nawigację), poprawiłbym design, a tak stronę postawiłem na Bootstrapie. 
4. Jak wspomniałem wcześniej - można dodać niektóre funkcjonalności, np. dodawanie, czy zarządzanie kategoriami, ale to jest w zasadzie po prostu CRUD.

