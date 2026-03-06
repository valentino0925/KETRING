const PRODUCTS = [
  // Piercings
  {
    id: "1",
    name: "Titán csillag alakú, köves dermál fej",
    price: 6999,
    category: "piercings",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/D/e/Dermal_87_ST_2.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "A titánból készült csillag alakú dermál ékszer bizonyítja, hogy még a legkisebb csillagok is képesek a legfényesebben ragyogni. Közepén egy áttetsző cirkónia kő ül, amely annyi fényt fog meg, hogy másodszorra is rá kell pillantanod. Hipoallergén, ASTM F136 titánból készült, vízálló, tartós, és 1,6mm-es dermálokhoz, 1,2 mm-es külső menettel illeszkedik. A megfelelő eszközökkel könnyedén cserélhető, ha új megjelenésre vágysz. Egyszerű, biztonságos, és egy kis odafigyeléssel tökéletes. Azoknak, akik a visszafogott eleganciát részesítik előnyben, ám ez a darab mégis megtalálja a módját, hogy kitűnjön.",
    material: "Titán",
  },
  {
    id: "2",
    name: "Dermal fej csillogó köves, 8-szirmos virág dísszel",
    price: 2599,
    category: "piercings",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/D/e/Dermal_73_ST.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "Ez a nem mindennapi dermal fej piercing rengeteg csodálatos kis kővel van kirakva. A középső nagyobb méretű kő egy csodásan csillogó, csiszolt cirkónia, körülötte pedig több ovális formájú kő is található amik a virág szirmait formázzák. Ezeket egy nap alakú réz szerkezet tartja fixen a helyén, ami a dísz tetején helyezkedik el és ugyanígy vannak a piercing hátulján is rögzítve a kövek. A réz részek el lettek látva egy bevonattal, hogy több színben is elérhető legyen számodra ez a különleges modell. A kövek színe mindig áttetsző marad, attól függetlenül, hogy milyen színben rendeled meg az alap szerkezetet.A piercing hátulján található csavaros rész (ami a dermal talpba illeszkedik majd) orvosi acélból készült. Ez a szár nem teljesen az ékszer hátuljának közepén található, hanem kicsit a széle felé. Ez a megoldás segíti a középső nagyobb méretű kő beépülését a szerkezetbe. Rendeld meg most ezt a csodás dermal fej piercinget, ha szeretnéd különlegesebbé tenni megjelenésedet!",
    material: "Orvosi acél / Sárgaréz",
  },
  {
    id: "3",
    name: "Patkó titánból",
    price: 2599,
    category: "piercings",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/H/o/Horseshoe_3_ST_1_product_picture.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "Ez a 23-as kategóriájú titánból készült patkó kiváló minőségű piercing. A hajlított barbellek, vagyis patkó piercingek használhatók: ajak piercingként szemöldök piercingként mellbimbó piercingként tragus piercingként helix piercingként eptum piercingként zinte bárhogyan viselhető, széleskörűen hordják sokféleképpen.A patkó 23-as kategóriájú titánból készült, ami az egyik legjobb a piacon. A titán nem tartalmaz nikkelt, így allergiások is hordhatják. Képes alkalmazkodni a test dinamikájához, így nem csoda, hogy az egyik legfelkapottabb alapanyag a piercingek világban.Webshopunkban kedvező áron tudod megvásárolni ezt a magas minőségű titán ékszert.",
    material: "Titán",
  },
  {
    id: "4",
    name: "Köldök piercing orvosi acélból, belső menettel és kővel",
    price: 2499,
    category: "piercings",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/B/e/Belly_403_ST_C_1_product_picture.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "Ha épp valami elegáns és kortalan ékszerre vadászol, akkor nem kell tovább keresned. A legtöbb ember amikor testékszert vásárol, a nagyon csillogó, extra nőies motivumokat keresi. Ha azonban te a diszkrétebb vonalat képviseled, akkor mindenképp tekintsd meg ezt a modellt. A fényes ezüst bármilyen stilushoz és szinösszeállitáshoz tökéletesen passzol. Emellett ez az ékszer belső menetes kialakitású. Ez azt jelenti, hogy a menet a szár belsejében található, és nem érintkezik a bőrrel, tehát nem tudja felsérteni azt. Az alsó és felső golyót egy-egy ékkő berakás disziti, aminek a szinét te választhatod ki.",
    material: "Orvosi acél",
  },
  
  // Tools
  {
    id: "5",
    name: "Steril bőrjelölő toll",
    price: 259,
    category: "tools",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/T/o/Tool_32.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "Ez egy egyszer használatos eszköz piercingekhez és tetoválásokhoz. Előre sterilizált, és használat után el kell dobni. Használat közben észre fogod venni, hogy ahogy szárad a tinta, úgy lesz sötétebb. A felesleges tintát alkohollal tudod letörölni.",
  },
  {
    id: "6",
    name: "Karika nyitó fogó",
    price: 1599,
    category: "tools",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/T/o/Tool_20.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "Ez a piercing karikanyitó eszköz arra való, hogy a nagyobb méretű karikáidat gond nélkül tudd nyitni és zárni. Három különböző méretben rendelheted, attól függően, mennyire nagy ékszerhez szeretnéd használni. A kisebb méretű fogó 4 mm-nél kisebb karikákhoz ideális. Ha ennél nagyobbak a karikáid, akkor mindenképpen a nagyobb fogóra van szükséged. Természetesen kisebb karikákat is meg tudsz fogni a nagyobbal is, a sztenderd 1,2 mm-es vastagságúakat is. A kisebb eszköz jobban kézre áll, egyszerűbb használni. Viszont a nagyobb elengedhetetlen nagy méretű ékszerekhez. ",
  },

  {
    id: "7",
    name: "Mosquito piercingtű önkioldó katéterrel 50 db-os doboz",
    price: 12999,
    category: "tools",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/n/e/needle_6.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "A Mosquito márkájú tűk kifejezetten piercingszúrásra készültek, semmi másra célra nem használhatók.A Mosquito tűk nagyon hegyesek, és etilén-oxiddal lettek fertőtlenítve. 50 darab egyenként fertőtlenített tű van minden dobozban. Mindegyikhez tartozik egy katéter. Ami különlegessé teszi ezt a terméket, az az, hogy nincs szükség ollóra a katéter levágásához.  A tű egy önkioldó funkcióval rendelkezik, ami azt jelenti, hogy a színes rész elválik a tűtől szúrás után. Ennek köszönhetően csak a katéter marad a bőr alatt, amivel már illeszthető is az ékszer.",
  },
  
  // Accessories
  {
    id: "8",
    name: "Köldök piercing titánból, kő dísszel",
    price: 4999,
    category: "piercings",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/B/e/Belly_70_ST_C_1_product_picture1.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "Ez a gyönyörű köldök piercing nem másból, mint titánból készült, ami a testékszerek világában a legkiválóbb alapanyag. Akkor is viselheted, ha piercinged még gyógyuló félben van, vagy ha nikkelallergiás vagy. A golyóban található kő nincs ragasztva, így pici mozgás előfordulhat a foglalaton belül. A klasszikus hajlított barbell szár tetején és alján is köves díszítés található. Több különleges színben is elérhető a modell - találj rá kedvencedre még ma!",
    material: "Titán",
  },
  {
    id: "9",
    name: "Szegmens karika piercing titánból",
    price: 2499,
    category: "piercings",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/R/i/Ring_117_ST_1_productpicture1_1.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "Ez a karika olyan könnyű, mint amennyire egyszerűen használható. Minél nagyobb méretű, annál könnyebben nyitható és zárható. Viszont minél kisebb az átmérője és minél vastagabb, annál nehezebb bánni vele. Ezért azt javasoljuk, hogy mindig legyen kéznél egy karika nyitó és záró fogó. Ezt a webáruház Eszközök kategóriája alatt találod meg. Meg fogsz lepődni, hogy milyen gyakran fogod használni. Valószínűleg ennél jobb minőségű és könnyebben kezelhető karikát nem találsz. A titán kétségtelenül a legjobb piercing anyag, amelyet új piercingeknél is használhatsz. A titán nikkelmentes, így allergiások számára is tökéletes.",
    material: "Titán",
  },
  {
    id: "10",
    name: "Piercinggolyó többféle színben",
    price: 2499,
    category: "accessories",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/B/a/Ball_21_GD_1_product_picture.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "Ezek a csodaszép piercing golyók mind orvosi acélból készültek, és egy vékony réteg titán bevonatot kaptak, az ionizálásnak nevezett folya Arany Rose gold Lila Sajnos nem mindegyik szín kapható minden méretben. Ne felejtsd el a megfelelő méretet választani a piercingedhez, mind átmérő és menetvastagság szempontjából.",
    material: "Orvosi acél",
  },
  {
    id: "11",
    name: "Dupla összekötő lánc titánból",
    price: 3999,
    category: "accessories",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/P/a/Part_27_ST_1_product_picture.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "Ez az ékszerdarab két titán láncból áll, két végein egy-egy O karikával vannak összekapcsolva, amelyek könnyen illeszthetőek piercingékszereidhez. Például, illesztheted egyik végét egy fülcimpában lévő karikához, vagy labrethez, másik végét pedig egy helix piercingben lévő karikához vagy labrethez. A lehetőségek száma végtelen! A láncok titánból készültek, ezért kopásállók, és elég erősek a gyakori viseléshez. A láncszemek 1,5 mm-esek, a karikák pedig 1,9 mm átmérőjűek.",
    material: "Titán",
  },
  {
    id: "12",
    name: "Labret 14 karátos aranyból, belső menettel és kővel",
    price: 54999,
    category: "piercings",
    image: "https://images.bodymod.hu/media/catalog/product/cache/66ff6701000170c81cb5f5121ef5c488/L/a/Labret_124_GD_3_product_picture.jpg?fill=solid&fill-color=ffffff&auto=format&w=1080",
    description: "Ezt a labretet több testrészedben is hordhatod. A lapos hátsó része miatt a legtöbben ajak- és fülpiercingnek választják. A szájban a lapos hátsó részzel rendelkező ékszerek viselése kényelmesebb, mint egy hagyományos golyós piercingé. A labret 14 karátos aranyból készült, és klasszikus sárgaarany, rózsaarany és fehérarany színben kapható. Mindhárom modellben azonos mennyiségű arany van. Nem csak a színt választhatod ki, de az ékszer hosszáról és a tetején lévő kő méretéről is te dönthetsz. Ha olyan szerencsés vagy, hogy a füled három helyen is ki van szúrva, kombinálhatod a különböző darabokat: helixben remekül mutat a három különböző, nagyság szerinti sorendben elhelyezett kő. A labret extra hosszú belső menettel rendelkezik, ezért a behelyezéskor a megfelelő rögzítéshez többször kell elfogatni, de így biztos lehetsz benne, hogy a kő nem fog kiesni. Ezt az ékszert több testrészedben is hordhatod. Az anyaga 14 karátos arany, ezért sokkal tartósabb, mint egy hagyományos piercing.",
    material: "Arany",
  }
];

// --- ÁLLAPOT (STATE) ---
let cartItems = [];
let selectedCategory = "all";
let cartOpen = false;

// --- KOSÁR MŰVELETEK ---
function handleAddToCart(productId) {
  const product = PRODUCTS.find(p => p.id === productId);
  if (!product) return;

  const existingItem = cartItems.find(item => item.id === productId);
  if (existingItem) {
    existingItem.quantity += 1;
  } else {
    cartItems.push({ ...product, quantity: 1 });
  }
  updateUI();
}

function handleRemoveItem(productId) {
  cartItems = cartItems.filter(item => item.id !== productId);
  updateUI();
}

function handleUpdateQuantity(productId, newQuantity) {
  if (newQuantity < 1) return handleRemoveItem(productId);
  const item = cartItems.find(i => i.id === productId);
  if (item) item.quantity = newQuantity;
  updateUI();
}

// --- RENDERELÉS ÉS UI FRISSÍTÉS ---
function updateUI() {
  // Kosár számláló frissítése a fejlécben
  const count = cartItems.reduce((sum, item) => sum + item.quantity, 0);
  const countBadge = document.getElementById('cartCount');
  if (countBadge) {
    countBadge.innerText = count;
    count > 0 ? countBadge.classList.remove('hidden') : countBadge.classList.add('hidden');
  }

  // Termékek újrarajzolása
  renderProducts();
  
  // Ha van kosár oldalsávod, annak a frissítése
  if (typeof renderCartSidebar === 'function') renderCartSidebar();
}

function renderProducts() {
  const grid = document.getElementById('product-grid');
  if (!grid) return;

  const filtered = selectedCategory === "all" 
    ? PRODUCTS 
    : PRODUCTS.filter(p => p.category === selectedCategory);

  grid.innerHTML = filtered.map(product => `
    <div class="group relative bg-zinc-900 border border-zinc-800 overflow-hidden hover:border-zinc-600 transition-all">
      <div class="aspect-square overflow-hidden bg-zinc-950">
        <img src="${product.image}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
      </div>
      <div class="p-4">
        <div class="flex items-start justify-between gap-2 mb-2">
          <h3 class="text-white uppercase tracking-wide text-sm">${product.name}</h3>
          <span class="text-white">${product.price} Ft</span>
        </div>
        ${product.material ? `<p class="text-xs text-zinc-500 uppercase mb-3">${product.material}</p>` : ''}
        <p class="text-xs text-zinc-400 mb-4 line-clamp-2">${product.description}</p>
        <button onclick="handleAddToCart('${product.id}')" class="w-full bg-white text-black hover:bg-zinc-200 uppercase tracking-wider text-xs h-9 font-bold transition-colors">
          Kosárba
        </button>
      </div>
    </div>
  `).join('');
}

function filterByCategory(category, btn) {
  selectedCategory = category;
  
  // Gombok stílusának váltása
  document.querySelectorAll('.filter-btn').forEach(b => {
    b.classList.remove('bg-white', 'text-black', 'border-white');
    b.classList.add('bg-transparent', 'text-zinc-400', 'border-zinc-700');
  });
  btn.classList.add('bg-white', 'text-black', 'border-white');
  btn.classList.remove('bg-transparent', 'text-zinc-400', 'border-zinc-700');

  renderProducts();
}

// --- CART SIDEBAR FUNKCIÓK ---

function toggleCart(open) {
  const sidebar = document.getElementById('cartSidebar');
  const overlay = document.getElementById('cartOverlay');
  
  if (!sidebar || !overlay) return;
  
  if (open) {
    sidebar.classList.remove('translate-x-full');
    overlay.classList.remove('opacity-0', 'pointer-events-none');
    document.body.style.overflow = 'hidden';
  } else {
    sidebar.classList.add('translate-x-full');
    overlay.classList.add('opacity-0', 'pointer-events-none');
    document.body.style.overflow = '';
  }
}

function renderCartSidebar() {
  const cartItemsContainer = document.getElementById('cartItems');
  const cartTotalEl = document.getElementById('cartTotal');
  
  if (!cartItemsContainer) return;
  
  if (cartItems.length === 0) {
    cartItemsContainer.innerHTML = `
      <div class="flex flex-col items-center justify-center h-full text-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-zinc-600 mb-4">
          <circle cx="8" cy="21" r="1"></circle>
          <circle cx="19" cy="21" r="1"></circle>
          <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.1-5.38a1 1 0 0 0-1-1.21H5.75"></path>
        </svg>
        <p class="text-zinc-500 uppercase tracking-wider text-sm">A kosár üres</p>
      </div>
    `;
  } else {
    cartItemsContainer.innerHTML = cartItems.map(item => `
      <div class="flex gap-4 p-3 bg-zinc-900 border border-zinc-800">
        <div class="w-20 h-20 flex-shrink-0 bg-zinc-950 overflow-hidden">
          <img src="${item.image}" class="w-full h-full object-cover" />
        </div>
        <div class="flex-1 flex flex-col justify-between">
          <div>
            <h4 class="text-white uppercase tracking-wide text-sm">${item.name}</h4>
            <p class="text-zinc-500 text-xs">${item.material || item.category}</p>
          </div>
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
              <button onclick="handleUpdateQuantity('${item.id}', ${item.quantity - 1})" class="w-6 h-6 flex items-center justify-center bg-zinc-800 text-white hover:bg-zinc-700">-</button>
              <span class="text-white text-sm w-6 text-center">${item.quantity}</span>
              <button onclick="handleUpdateQuantity('${item.id}', ${item.quantity + 1})" class="w-6 h-6 flex items-center justify-center bg-zinc-800 text-white hover:bg-zinc-700">+</button>
            </div>
            <span class="text-white font-bold">${(item.price * item.quantity).toFixed(0)} Ft</span>
          </div>
        </div>
        <button onclick="handleRemoveItem('${item.id}')" class="self-start p-1 text-zinc-500 hover:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>
    `).join('');
  }
  
  // Összesen frissítése
  const total = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
  if (cartTotalEl) {
    cartTotalEl.innerText = total.toFixed(0) + ' Ft';
  }
}

// Indítás
document.addEventListener('DOMContentLoaded', updateUI);
