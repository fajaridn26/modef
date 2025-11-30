/* eslint-disable @next/next/no-img-element */
import { Badge, Button } from "#/base";
import { Brands } from "#/Brands";
import { cn } from "@/lib/utils";
import { motion } from "motion/react";

export function HeroSection({
  badge,
  title,
  description,
  buttons,
  image,
  clientsLabel,
  clients,
  ...rest
}) {
  return (
    <section {...rest}>
      <div className="container px-4 mx-auto">
        <div className="flex flex-col justify-center items-center">
          <div className="flex flex-col justify-center items-center gap-4 text-center max-w-3xl mx-auto py-28">
            <Badge {...badge} />
            <motion.h1
              className="text-6xl font-display font-semibold title-gradient"
              animate={{ y: 0, opacity: 1 }}
              initial={{ y: -100, opacity: 0 }}
              transition={{ duration: 0.8 }}
            >
              {title}
            </motion.h1>
            <motion.p
              className="text-xl mt-4"
              animate={{ y: 0, opacity: 1 }}
              initial={{ y: 100, opacity: 0 }}
              transition={{ duration: 0.8 }}
            >
              {description}
            </motion.p>
            {buttons.length > 0 && (
              <motion.div
                className="flex justify-center items-center gap-4 mt-8"
                initial={{ opacity: 0, scale: 0 }}
                animate={{ opacity: 1, scale: 1 }}
                transition={{
                  duration: 1.0,
                  scale: { type: "spring", visualDuration: 0.4, bounce: 0.5 },
                }}
              >
                {buttons.map((button, index) => (
                  <Button key={index} {...button} />
                ))}
              </motion.div>
            )}
          </div>
          {/* <div>
            <img
              src={image.src}
              alt={image.alt}
              className={cn("w-full h-auto", image.className)}
            />
          </div> */}

          {/* <div className="text-sm">{clientsLabel}</div>
          <Brands clients={clients} /> */}
        </div>
      </div>
    </section>
  );
}
