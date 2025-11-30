import Head from "next/head";
import { Header, Footer } from "../components/sections";

import { header, footer } from "../data";

import axios from "axios";
import { useEffect, useState } from "react";
import { useRouter } from "next/router";
import dynamic from "next/dynamic";
import { motion } from "motion/react";
import Link from "next/link";
export default function Home() {
  const router = useRouter();
  const { keyword } = router.query;
  const [projects, setProjects] = useState([]);
  const DynamicImage = dynamic(() => import("../components/DynamicImage"), {
    ssr: false,
  });
  const truncate = (text, maxLength) => {
    return text.length > maxLength
      ? text.substring(0, maxLength) + "..."
      : text;
  };

  useEffect(() => {
    if (!keyword) return;
    const url = `http://localhost:8000/api/projects/search?keyword=${keyword}`;

    axios.get(url).then((res) => {
      setProjects(res.data.data);
      // console.log(res.data.data, "AAA");
    });
  }, [keyword]);

  return (
    <>
      <Head>
        <title>WindMill</title>
      </Head>
      <Header
        logo={header.logo}
        links={header.links}
        buttons={header.buttons}
      />

      <motion.div
        className="container mx-auto text-2xl font-semibold text-black text-center capitalize py-28"
        animate={{ y: 0, opacity: 1 }}
        initial={{ y: -100, opacity: 0 }}
        transition={{ duration: 0.8 }}
      >
        {keyword}
      </motion.div>

      <div className="container mx-auto grid grid-cols-1 xl:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-4">
        {projects.map((item) => (
          <motion.div
            key={item.id}
            className="mx-auto max-w-sm mb-6"
            animate={{ y: 0, opacity: 1 }}
            initial={{ y: 100, opacity: 0 }}
            transition={{ duration: 0.8 }}
          >
            <div className="group relative overflow-hidden">
              <Link href={`/${item.slug}`}>
                <DynamicImage
                  src={item.image_url}
                  alt={item.nama_project}
                  width={500}
                  height={300}
                  className="max-w-full"
                />
              </Link>
              <div
                className="absolute bottom-0 left-0 w-full 
                  bg-gradient-to-t from-black/50 via-black/30 to-transparent
                  text-md font-bold text-white text-start py-3 
                  opacity-0 group-hover:opacity-100 
                  transition-all duration-300 p-4"
              >
                {truncate(item.nama_project, 33)}
              </div>
            </div>
            <div className="mt-4 text-sm font-semibold">{item.user.nama}</div>
          </motion.div>
        ))}
      </div>
      {projects.length === 0 && (
        <div className="flex justify-center items-center text-xl font-semibold mb-28">
          Tidak ada Portfolio.
        </div>
      )}

      <Footer
        id="footer"
        copyright={footer.copyright}
        logo={footer.logo}
        social={footer.social}
        links={footer.links}
      />
    </>
  );
}
