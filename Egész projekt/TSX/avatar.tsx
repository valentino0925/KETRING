import { ShoppingCart } from "lucide-react";
import { Button } from "@/app/components/ui/button";

export interface Product {
  id: string;
  name: string;
  price: number;
  category: "piercings" | "tools" | "accessories";
  image: string;
  description: string;
  material?: string;
}

interface ProductCardProps {
  product: Product;
  onAddToCart: (product: Product) => void;
}

export function ProductCard({ product, onAddToCart }: ProductCardProps) {
  return (
    <div className="group relative bg-zinc-900 border border-zinc-800 overflow-hidden hover:border-zinc-600 transition-all">
      {/* Image Container */}
      <div className="aspect-square overflow-hidden bg-zinc-950">
        <img
          src={product.image}
          alt={product.name}
          className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
        />
      </div>

      {/* Content */}
      <div className="p-4">
        <div className="flex items-start justify-between gap-2 mb-2">
          <h3 className="text-white uppercase tracking-wide text-sm">
            {product.name}
          </h3>
          <span className="text-white flex-shrink-0">
            ${product.price}
          </span>
        </div>

        {product.material && (
          <p className="text-xs text-zinc-500 uppercase tracking-wider mb-3">
            {product.material}
          </p>
        )}

        <p className="text-xs text-zinc-400 mb-4 line-clamp-2">
          {product.description}
        </p>

        <Button
          onClick={() => onAddToCart(product)}
          className="w-full bg-white text-black hover:bg-zinc-200 uppercase tracking-wider text-xs h-9"
        >
          <ShoppingCart className="w-4 h-4 mr-2" />
          Add to Cart
        </Button>
      </div>
    </div>
  );
}
