import { ShoppingCart, Menu, X } from "lucide-react";
import { useState } from "react";
import { Button } from "@/app/components/ui/button";

interface HeaderProps {
  cartItemsCount: number;
  onCartClick: () => void;
}

export function Header({ cartItemsCount, onCartClick }: HeaderProps) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  return (
    <header className="fixed top-0 left-0 right-0 z-50 bg-black border-b border-zinc-800">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Logo */}
          <div className="flex items-center">
            <h1 className="text-2xl tracking-[0.2em] uppercase text-white">
              Ketring
            </h1>
          </div>

          {/* Desktop Navigation */}
          <nav className="hidden md:flex items-center gap-8">
            <a href="#piercings" className="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">
              Piercings
            </a>
            <a href="#tools" className="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">
              Tools
            </a>
            <a href="#accessories" className="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">
              Accessories
            </a>
            <a href="#about" className="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">
              About
            </a>
          </nav>

          {/* Cart & Mobile Menu */}
          <div className="flex items-center gap-4">
            <button
              onClick={onCartClick}
              className="relative p-2 text-white hover:text-zinc-400 transition-colors"
            >
              <ShoppingCart className="w-5 h-5" />
              {cartItemsCount > 0 && (
                <span className="absolute -top-1 -right-1 bg-white text-black text-xs w-5 h-5 rounded-full flex items-center justify-center">
                  {cartItemsCount}
                </span>
              )}
            </button>

            <button
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              className="md:hidden p-2 text-white"
            >
              {mobileMenuOpen ? <X className="w-5 h-5" /> : <Menu className="w-5 h-5" />}
            </button>
          </div>
        </div>

        {/* Mobile Menu */}
        {mobileMenuOpen && (
          <div className="md:hidden py-4 border-t border-zinc-800">
            <nav className="flex flex-col gap-4">
              <a href="#piercings" className="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">
                Piercings
              </a>
              <a href="#tools" className="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">
                Tools
              </a>
              <a href="#accessories" className="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">
                Accessories
              </a>
              <a href="#about" className="text-sm text-zinc-400 hover:text-white transition-colors uppercase tracking-wider">
                About
              </a>
            </nav>
          </div>
        )}
      </div>
    </header>
  );
}
