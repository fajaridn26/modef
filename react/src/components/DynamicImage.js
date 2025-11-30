import Image from "next/image";
import { useState } from "react";
export default function DynamycImage({
  src,
  alt,
  width,
  height,
  className = "",
  ...props
}) {
  const [loading, setLoading] = useState(true);
  return (
    <div className="relative w-full h-full">
      {loading && (
        <div className="absolute inset-0 bg-gray-200 animate-pulse rounded md" />
      )}
      <Image
        src={src}
        alt={alt}
        width={width}
        height={height}
        {...props}
        onLoadingComplete={() => setLoading(false)}
        className={`${className} rounded-md transition-all duration-300 ${
          loading ? "opacity-0" : "opacity-100"
        }`}
      />
    </div>
  );
}
