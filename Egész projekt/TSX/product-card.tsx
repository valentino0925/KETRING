import { X, Trash2 } from "lucide-react";
import { Button } from "@/app/components/ui/button";
import { Product } from "@/app/components/product-card";

interface CartItem extends Product {
  quantity: number;
}

interface CartSidebarProps {
  isOpen: boolean;
  onClose: () => void;
  cartItems: CartItem[];
  onRemoveItem: (productId: string) => void;
  onUpdateQuantity: (productId: string, quantity: number) => void;
}

export function CartSidebar({
  isOpen,
  onClose,
  cartItems,
  onRemoveItem,
  onUpdateQuantity,
}: CartSidebarProps) {
  const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);

  return (
    <>
      {/* Overlay */}
      {isOpen && (
        <div
          className="fixed inset-0 bg-black/60 z-50"
          onClick={onClose}
        />
      )}

      {/* Sidebar */}
      <div
        className={`fixed right-0 top-0 h-full w-full max-w-md bg-zinc-950 border-l border-zinc-800 z-50 transform transition-transform duration-300 ${
          isOpen ? "translate-x-0" : "translate-x-full"
        }`}
      >
        <div className="flex flex-col h-full">
          {/* Header */}
          <div className="flex items-center justify-between p-6 border-b border-zinc-800">
            <h2 className="text-xl uppercase tracking-wider text-white">Cart</h2>
            <button
              onClick={onClose}
              className="p-2 hover:bg-zinc-800 rounded-lg transition-colors text-white"
            >
              <X className="w-5 h-5" />
            </button>
          </div>

          {/* Cart Items */}
          <div className="flex-1 overflow-y-auto p-6">
            {cartItems.length === 0 ? (
              <div className="flex items-center justify-center h-full">
                <p className="text-zinc-500 text-sm uppercase tracking-wider">
                  Your cart is empty
                </p>
              </div>
            ) : (
              <div className="space-y-4">
                {cartItems.map((item) => (
                  <div
                    key={item.id}
                    className="flex gap-4 pb-4 border-b border-zinc-800"
                  >
                    <img
                      src={item.image}
                      alt={item.name}
                      className="w-20 h-20 object-cover bg-zinc-900"
                    />
                    <div className="flex-1">
                      <h3 className="text-white text-sm uppercase tracking-wide mb-1">
                        {item.name}
                      </h3>
                      <p className="text-zinc-400 text-xs mb-2">
                        ${item.price}
                      </p>
                      <div className="flex items-center gap-2">
                        <button
                          onClick={() =>
                            onUpdateQuantity(item.id, Math.max(1, item.quantity - 1))
                          }
                          className="w-6 h-6 bg-zinc-800 hover:bg-zinc-700 text-white rounded flex items-center justify-center text-sm"
                        >
                          -
                        </button>
                        <span className="text-white text-sm w-8 text-center">
                          {item.quantity}
                        </span>
                        <button
                          onClick={() => onUpdateQuantity(item.id, item.quantity + 1)}
                          className="w-6 h-6 bg-zinc-800 hover:bg-zinc-700 text-white rounded flex items-center justify-center text-sm"
                        >
                          +
                        </button>
                      </div>
                    </div>
                    <button
                      onClick={() => onRemoveItem(item.id)}
                      className="text-zinc-500 hover:text-red-500 transition-colors"
                    >
                      <Trash2 className="w-4 h-4" />
                    </button>
                  </div>
                ))}
              </div>
            )}
          </div>

          {/* Footer */}
          {cartItems.length > 0 && (
            <div className="p-6 border-t border-zinc-800">
              <div className="flex items-center justify-between mb-4">
                <span className="text-zinc-400 uppercase tracking-wider text-sm">
                  Total
                </span>
                <span className="text-white text-xl">
                  ${total.toFixed(2)}
                </span>
              </div>
              <Button className="w-full bg-white text-black hover:bg-zinc-200 uppercase tracking-wider h-12">
                Checkout
              </Button>
            </div>
          )}
        </div>
      </div>
    </>
  );
}
