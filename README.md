MAGENTO Tema Geliştirme Eğitim Paketi ve Ödevi

Bu dokümanda SEKİZGEN için bir tema geliştirmek ve bu temayı geliştirirken MAGENTO yapısını öğrenmek için gereken adımlara ve dokümanlara ulaşabilirsiniz. Gerekli eğitim tamamlandıktan sonra SEKİZGEN adına bir tema yapmak için gereken bilgileri de yine bu dokümanın sonunda bulabileceksiniz. 

İşe başlamadan önce bol miktarda okuma yapmanız gerekmektedir. İşe yarar dokümanların bağlantıları ve açıklamalarına aşağıdan ulaşabilirsiniz.

MAGENTO Resmi İnternet Sitesi:
http://www.magentocommerce.com

MAGENTO kaynak kodlarını indirmek için gereken bağlantı. SEKİZGEN, geliştirmelerini şu anda 1.7.0.2 versiyonunu üzerine yapmaktadır.
http://www.magentocommerce.com/download

Lokal bilgisayarınızda geliştirme ortamınızı hazırlamak ve MAGENTO platformunu lokalinize kurmak için bilgi:
http://www.magentocommerce.com/wiki/1_-_installation_and_configuration/magento_installation_guide

Eğer lokal geliştirme ortamınız MacOSX ise dikkat edilmesi gereken adımlar:
http://www.magentocommerce.com/wiki/1_-_installation_and_configuration/installing-magento-on-mac-os-x-server-10-4-9

SEKİZGEN firmasına özel örnek veri tabanının geliştirme ortamınıza kurulumu ile ilgili detaylı bilgiler
https://github.com/SekizGen/magento_dev/wiki/Örnek-Veritabanı-Kurulumu

MAGENTO Kullanım Kitabı: Bu dokümanda özellikle “Product Types” ve açıklamaları dikkatlice incelenmelidir. Ayrıca MAGENTO standart özellikleri ve onların kullanımlarını öğrenmek için her zaman bu kitaba başvurabilirsiniz. Bir çeşit başucu el kitabıdır.
http://www.magentocommerce.com/resources/magento-user-guide

MAGENTO Tasarımcı Rehberi: Bu doküman dahilindeki ödevi yerine getirmek için en önemli doküman bu dokümandır. Son derece dikkatlice okunmalıdır. 
http://www.magentocommerce.com/design_guide

MAGENTO platformu üzerinde modül geliştirme ve her türlü bilgi aşağıdadır. 8 bölümden oluşmaktadır. Her bölümdeki egzersizleri yaparak öğrenmenizi hızlandırabilirsiniz. Buradaki egzersizleri bize göndermenize gerek yoktur. Sizin öğrenmeniz içindir.
•  http://www.magentocommerce.com/knowledge-base/entry/magento-for-dev-part-1-introduction-to-magento
•	http://www.magentocommerce.com/knowledge-base/entry/magento-for-dev-part-2-the-magento-config
•	http://www.magentocommerce.com/knowledge-base/entry/magento-for-dev-part-3-magento-controller-dispatch
•	http://www.magentocommerce.com/knowledge-base/entry/magento-for-dev-part-4-magento-layouts-blocks-and-templates
•	http://www.magentocommerce.com/knowledge-base/entry/magento-for-dev-part-5-magento-models-and-orm-basics
•	http://www.magentocommerce.com/knowledge-base/entry/magento-for-dev-part-6-magento-setup-resources
•	http://www.magentocommerce.com/knowledge-base/entry/magento-for-dev-part-7-advanced-orm-entity-attribute-value
•	http://www.magentocommerce.com/knowledge-base/entry/magento-for-dev-part-8-varien-data-collections
Ödev

Ödev Tanımı:
Bu bilgiler ışığında sizden beklediğimiz ödeviniz şu şekildedir: Tarafınıza bu doküman ile birlikte bir web site tasarım dokümanı verilecektir. Bu doküman içinde ihtiyacınız olan logolar ve görsel tasarımı ifade eden dosyalar olacaktır. Buna göre bu tasarıma bakarak sizden bir MAGENTO teması oluşturmanız istenecektir.

Değerlendirme:
Eğer bu ödevinizi başarı ile yerine getirmek istiyorsanız “Design Guide” dokümanı en önemli dokümandır. İyi özümsemeli ve temanızı bu dokümandaki esaslara dikkat ederek geliştirmelisiniz. Değerlendirme yaparken aşağıdakine benzer konular dikkate alınarak değerlendirme yapılacaktır:
•	MAGENTO tema hiyerarşisinin anlamış iseniz temanızın içine gereksiz dosyaların kopyalanmış olup olmadığı kontrol edilecektir. 
•	Sadece standart/üst temadan farklılaştırma var ise tema içine kopyalama yapılmalı, eğer farklılaştırma yok ise üst temadaki dosyalardan faydalanılmalıdır. 
•	Yaptığınız değişikliğin etkisi sizin temanıza mı yoksa üst temaya mı ait olduğu değerlendirmeli doğru dosya değiştirilmelidir.
•	Üst temada değişiklik yapmış iseniz, neden üst temada değişiklik yaptığınız gerekçeleri ile detaylıca değişiklik bildirim açıklamasının (COMMIT) içine yazılmalıdır.
•	MAGENTO standart temaları ve dosyaları kesinlikle değiştirilmemelidir.
•	MVC kurallarına kesinlikle çok dikkatli uyulmalıdır. Temanızın hiç bir yerinde döngü veya bir koşul için gereken bir hesaplama olmamalı bu tip kodlar BLOCK sınıfları içinde olmalıdır.
•	Ödev teslim kurallarına uyum için gösterilen titizlik.

Ödev Teslimi:
Geliştirmiş olduğunuz kodlar tarafımıza GITHUB ile teslim edilecektir. Bu ödev için açılmış olan kod geliştirme havuzunun adresi aşağıdaki gibidir:
https://github.com/SekizGen/magento_dev

Değişiklik yönetimini yapma biçiminiz de değerlendirme kriterleri arasındadır. Aşağıdaki hususlara dikkat etmeniz beklenmektedir:
•	Ödevi teslim ederken tek bir değişiklik bildirimi (COMMIT) ile tüm temayı sakın bize gönderme!!!
•	Bir GITHUB kullanıcın yoksa, kullanıcı yaratarak kullanıcı adını bize göndermelisin ki SEKİZGEN kod havuzunda sana çalışma yetkisi verebilelim.
•	Geliştirmeye, hatta egzersizlere başlamadan önce kod havuzunu lokalinize çekin.
•	Geliştirmeye başlamadan önce yeni bir “BRANCH” (Dikkat!! “FORK” DEĞİL) yaratın ve bundan sonra tüm değişikliklerinizi bu “BRANCH” üzerine bildirin. “MASTER” üzerine herhangi bir  bildirim yapmayın. 
•	Akabinde her bir küçük/minik/atomik değişikliği, detaylı açıklama paragrafları ile bildirin. 
•	Değerlendirme sırasında bir bildirimin hatalı olup olmaması bizim için önemli değildir, aksine ne kadar çok hata yapıp bu hataları ne kadar çok düzeltirseniz ve bunları her bir bildirim ile detaylıca açıklarsanız o kadar çok puan alırsınız.
•	Bu değerlendirmeler sırasında en fazla puanı en fazla sayıda bildirim yapan alır. 
•	Ayrıca her bir bildirim açıklamasını ne kadar detaylı yazarsanız o kadar çok puan alırsınız.

