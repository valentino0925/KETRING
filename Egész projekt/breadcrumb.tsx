import { ArrowRight } from "lucide-react";
import { Button } from "@/app/components/ui/button";

export function HeroSection() {
  return (
    <section className="relative min-h-[60vh] flex items-center justify-center bg-gradient-to-b from-zinc-950 via-zinc-900 to-black border-b border-zinc-800">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div className="inline-block mb-4 px-4 py-2 border border-zinc-700 bg-zinc-900/50">
          <span className="text-zinc-400 text-xs uppercase tracking-[0.3em]">
            Est. 2026
          </span>
        </div>
        
        <h1 className="text-5xl sm:text-7xl md:text-8xl uppercase tracking-wider mb-6 text-white">
          Ketring
        </h1>
        
        <p className="text-lg sm:text-xl text-zinc-400 mb-8 max-w-2xl mx-auto tracking-wide">
          Premium piercings, professional tools, and essential accessories for body modification enthusiasts
        </p>
        
        <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
          <Button
            onClick={() => document.getElementById('products')?.scrollIntoView({ behavior: 'smooth' })}
            className="bg-white text-black hover:bg-zinc-200 px-8 h-12 uppercase tracking-wider"
          >
            Shop Now
            <ArrowRight className="w-4 h-4 ml-2" />
          </Button>
          <Button
            variant="outline"
            className="border-zinc-700 text-white hover:bg-zinc-900 px-8 h-12 uppercase tracking-wider"
          >
            Learn More
          </Button>
        </div>
      </div>

      {/* Decorative Elements */}
      <div className="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-zinc-700 to-transparent" />
    </section>
  );
}
