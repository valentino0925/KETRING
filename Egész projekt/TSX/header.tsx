import { useState } from "react";
import { Header } from "@/app/components/header";
import { HeroSection } from "@/app/components/hero-section";
import { ProductCard, Product } from "@/app/components/product-card";
import { CartSidebar } from "@/app/components/cart-sidebar";

interface CartItem extends Product {
  quantity: number;
}

const PRODUCTS: Product[] = [
  // Piercings
  {
    id: "1",
    name: "Gold Hoop Set",
    price: 45.00,
    category: "piercings",
    image: "https://images.unsplash.com/photo-1763316189806-8f5e553cb261?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlYXIlMjBwaWVyY2luZyUyMGpld2VscnklMjBnb2xkfGVufDF8fHx8MTc2OTk1ODI4OHww&ixlib=rb-4.1.0&q=80&w=1080",
    description: "14k gold plated seamless hoops. Perfect for helix, lobe, and septum piercings.",
    material: "14K Gold Plated",
  },
  {
    id: "2",
    name: "Silver Nose Ring",
    price: 28.00,
    category: "piercings",
    image: "https://images.unsplash.com/flagged/photo-1552425595-a5ff53172f75?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxub3NlJTIwcmluZyUyMHBpZXJjaW5nJTIwc2lsdmVyfGVufDF8fHx8MTc2OTk1ODI4OXww&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Sterling silver nose ring with secure closure. Hypoallergenic and tarnish-resistant.",
    material: "Sterling Silver",
  },
  {
    id: "3",
    name: "Body Jewelry Set",
    price: 65.00,
    category: "piercings",
    image: "https://images.unsplash.com/photo-1732737302646-bc3c288c3627?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxib2R5JTIwcGllcmNpbmclMjBqZXdlbHJ5fGVufDF8fHx8MTc2OTk1ODI4OXww&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Curated set of premium body jewelry. Includes barbells, hoops, and studs.",
    material: "Surgical Steel",
  },
  {
    id: "4",
    name: "Titanium Studs",
    price: 38.00,
    category: "piercings",
    image: "https://images.unsplash.com/photo-1689070901068-a7cae2bbc36f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxqZXdlbHJ5JTIwZGlzcGxheSUyMG1pbmltYWx8ZW58MXx8fHwxNzY5OTU4MjkwfDA&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Medical-grade titanium studs. Lightweight and biocompatible for sensitive skin.",
    material: "Medical Grade Titanium",
  },
  
  // Tools
  {
    id: "5",
    name: "Professional Piercing Kit",
    price: 120.00,
    category: "tools",
    image: "https://images.unsplash.com/photo-1625038032200-648fbcd800d0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwaWVyY2luZyUyMHRvb2xzJTIwc3RlcmlsZXxlbnwxfHx8fDE3Njk5NTgyOTB8MA&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Complete sterile piercing kit. Includes needles, forceps, and sterilization equipment.",
    material: "Stainless Steel",
  },
  {
    id: "6",
    name: "Precision Forceps",
    price: 35.00,
    category: "tools",
    image: "https://images.unsplash.com/photo-1625038032200-648fbcd800d0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwaWVyY2luZyUyMHRvb2xzJTIwc3RlcmlsZXxlbnwxfHx8fDE3Njk5NTgyOTB8MA&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Surgical-grade forceps for precise piercing placement. Autoclavable and durable.",
    material: "Surgical Steel",
  },
  {
    id: "7",
    name: "Sterilization Pouches",
    price: 18.00,
    category: "tools",
    image: "https://images.unsplash.com/photo-1625038032200-648fbcd800d0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwaWVyY2luZyUyMHRvb2xzJTIwc3RlcmlsZXxlbnwxfHx8fDE3Njk5NTgyOTB8MA&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Self-sealing sterilization pouches. Pack of 100 for maintaining sterile equipment.",
    material: "Medical Grade",
  },
  
  // Accessories
  {
    id: "8",
    name: "Aftercare Solution",
    price: 22.00,
    category: "accessories",
    image: "https://images.unsplash.com/photo-1616750819574-7e38aa8046fa?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxza2luY2FyZSUyMHByb2R1Y3RzJTIwYm90dGxlfGVufDF8fHx8MTc2OTk1ODI5M3ww&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Premium saline solution for piercing aftercare. Gentle and healing formula.",
    material: "Saline Solution",
  },
  {
    id: "9",
    name: "Jewelry Cleaner",
    price: 16.00,
    category: "accessories",
    image: "https://images.unsplash.com/photo-1616750819574-7e38aa8046fa?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxza2luY2FyZSUyMHByb2R1Y3RzJTIwYm90dGxlfGVufDF8fHx8MTc2OTk1ODI5M3ww&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Specially formulated cleaner for all types of body jewelry. Safe and effective.",
  },
  {
    id: "10",
    name: "Storage Case",
    price: 25.00,
    category: "accessories",
    image: "https://images.unsplash.com/photo-1689070901068-a7cae2bbc36f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxqZXdlbHJ5JTIwZGlzcGxheSUyMG1pbmltYWx8ZW58MXx8fHwxNzY5OTU4MjkwfDA&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Premium storage case for organizing your piercing jewelry collection.",
  },
  {
    id: "11",
    name: "Healing Balm",
    price: 19.00,
    category: "accessories",
    image: "https://images.unsplash.com/photo-1616750819574-7e38aa8046fa?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxza2luY2FyZSUyMHByb2R1Y3RzJTIwYm90dGxlfGVufDF8fHx8MTc2OTk1ODI5M3ww&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Natural healing balm for new piercings. Reduces irritation and promotes healing.",
  },
  {
    id: "12",
    name: "Travel Kit",
    price: 32.00,
    category: "accessories",
    image: "https://images.unsplash.com/photo-1689070901068-a7cae2bbc36f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxqZXdlbHJ5JTIwZGlzcGxheSUyMG1pbmltYWx8ZW58MXx8fHwxNzY5OTU4MjkwfDA&ixlib=rb-4.1.0&q=80&w=1080",
    description: "Complete travel kit with cleaning solution, cotton swabs, and storage.",
  },
];

export default function App() {
  const [cartOpen, setCartOpen] = useState(false);
  const [cartItems, setCartItems] = useState<CartItem[]>([]);
  const [selectedCategory, setSelectedCategory] = useState<string>("all");

  const handleAddToCart = (product: Product) => {
    setCartItems((prev) => {
      const existingItem = prev.find((item) => item.id === product.id);
      if (existingItem) {
        return prev.map((item) =>
          item.id === product.id
            ? { ...item, quantity: item.quantity + 1 }
            : item
        );
      }
      return [...prev, { ...product, quantity: 1 }];
    });
  };

  const handleRemoveItem = (productId: string) => {
    setCartItems((prev) => prev.filter((item) => item.id !== productId));
  };

  const handleUpdateQuantity = (productId: string, quantity: number) => {
    setCartItems((prev) =>
      prev.map((item) =>
        item.id === productId ? { ...item, quantity } : item
      )
    );
  };

  const filteredProducts =
    selectedCategory === "all"
      ? PRODUCTS
      : PRODUCTS.filter((p) => p.category === selectedCategory);

  const cartItemsCount = cartItems.reduce((sum, item) => sum + item.quantity, 0);

  return (
    <div className="min-h-screen bg-black text-white">
      <Header cartItemsCount={cartItemsCount} onCartClick={() => setCartOpen(true)} />
      
      <div className="pt-16">
        <HeroSection />

        {/* Products Section */}
        <section id="products" className="py-16 px-4 sm:px-6 lg:px-8">
          <div className="max-w-7xl mx-auto">
            {/* Category Filter */}
            <div className="mb-12">
              <div className="flex flex-wrap gap-3 justify-center">
                {["all", "piercings", "tools", "accessories"].map((category) => (
                  <button
                    key={category}
                    onClick={() => setSelectedCategory(category)}
                    className={`px-6 py-2 uppercase tracking-wider text-sm border transition-all ${
                      selectedCategory === category
                        ? "bg-white text-black border-white"
                        : "bg-transparent text-zinc-400 border-zinc-700 hover:border-zinc-500"
                    }`}
                  >
                    {category}
                  </button>
                ))}
              </div>
            </div>

            {/* Products Grid */}
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
              {filteredProducts.map((product) => (
                <ProductCard
                  key={product.id}
                  product={product}
                  onAddToCart={handleAddToCart}
                />
              ))}
            </div>
          </div>
        </section>

        {/* About Section */}
        <section id="about" className="py-20 px-4 sm:px-6 lg:px-8 bg-zinc-950 border-t border-zinc-800">
          <div className="max-w-4xl mx-auto text-center">
            <h2 className="text-4xl uppercase tracking-wider mb-6 text-white">
              About Ketring
            </h2>
            <p className="text-zinc-400 text-lg mb-8 leading-relaxed">
              We're dedicated to providing premium body jewelry, professional-grade tools, and essential accessories for the body modification community. Our products are carefully curated to meet the highest standards of quality, safety, and style.
            </p>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
              <div className="p-6 border border-zinc-800 bg-zinc-900/50">
                <h3 className="text-white uppercase tracking-wider mb-3">Quality Materials</h3>
                <p className="text-zinc-500 text-sm">
                  All jewelry is made from hypoallergenic materials including surgical steel, titanium, and gold.
                </p>
              </div>
              <div className="p-6 border border-zinc-800 bg-zinc-900/50">
                <h3 className="text-white uppercase tracking-wider mb-3">Sterile Tools</h3>
                <p className="text-zinc-500 text-sm">
                  Professional-grade equipment that meets industry standards for safety and precision.
                </p>
              </div>
              <div className="p-6 border border-zinc-800 bg-zinc-900/50">
                <h3 className="text-white uppercase tracking-wider mb-3">Expert Support</h3>
                <p className="text-zinc-500 text-sm">
                  Comprehensive aftercare guides and customer support for all your piercing needs.
                </p>
              </div>
            </div>
          </div>
        </section>

        {/* Footer */}
        <footer className="py-12 px-4 sm:px-6 lg:px-8 border-t border-zinc-800">
          <div className="max-w-7xl mx-auto">
            <div className="flex flex-col md:flex-row justify-between items-center gap-6">
              <div>
                <h3 className="text-2xl uppercase tracking-[0.2em] text-white mb-2">
                  Ketring
                </h3>
                <p className="text-zinc-500 text-sm">
                  Premium piercings & accessories
                </p>
              </div>
              <div className="flex gap-8 text-sm">
                  <a href="#" className="text-zinc-500 hover:text-white transition-colors uppercase tracking-wider">
                  Privacy
                </a>
                <a href="#" className="text-zinc-500 hover:text-white transition-colors uppercase tracking-wider">
                  Terms
                </a>
                <a href="#" className="text-zinc-500 hover:text-white transition-colors uppercase tracking-wider">
                  Contact
                </a>
              </div>
            </div>
            <div className="mt-8 pt-8 border-t border-zinc-900 text-center">
              <p className="text-zinc-600 text-xs uppercase tracking-wider">
                © 2026 Ketring. All rights reserved.
              </p>
            </div>
          </div>
        </footer>
      </div>

      <CartSidebar
        isOpen={cartOpen}
        onClose={() => setCartOpen(false)}
        cartItems={cartItems}
        onRemoveItem={handleRemoveItem}
        onUpdateQuantity={handleUpdateQuantity}
      />
    </div>
  );
}
