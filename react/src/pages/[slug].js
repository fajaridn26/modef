import Head from "next/head";
import { Header, Footer } from "../components/sections";

import { header, footer } from "../data";

import axios from "axios";
import { useEffect, useState } from "react";
import { useRouter } from "next/router";
import { Button } from "@/components/base";
import Link from "next/link";
import dynamic from "next/dynamic";
import { motion } from "motion/react";
export default function Home() {
  const router = useRouter();
  const { slug } = router.query;
  const [projects, setProjects] = useState(null);
  const DynamicImage = dynamic(() => import("../components/DynamicImage"), {
    ssr: false,
  });

  useEffect(() => {
    if (!slug) return;
    const url = `http://localhost:8000/api/projects/${slug}`;

    axios.get(url).then((res) => {
      setProjects(res.data.data[0]);
    });
  }, [slug]);

  if (!projects)
    return (
      <div className="flex items-center justify-center min-h-screen">
        Loading...
      </div>
    );

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

      <div className="container mx-auto py-28">
        {/* <div className="fixed container bg-base-50 z-10"> */}
        <motion.div
          className="font-semibold text-2xl text-gray-800 mb-6"
          animate={{ y: 0, opacity: 1 }}
          initial={{ y: 100, opacity: 0 }}
          transition={{ duration: 0.8 }}
        >
          {projects.nama_project}
        </motion.div>
        <div className="flex justify-between items-center mb-8">
          <div>
            <motion.div
              className="font-semibold text-gray-800 text-md"
              animate={{ x: 0, opacity: 1 }}
              initial={{ x: -100, opacity: 0 }}
              transition={{ duration: 0.8 }}
            >
              {projects.user.nama}
            </motion.div>
            <motion.p
              className="text-sm text-light mt-2"
              animate={{ x: 0, opacity: 1 }}
              initial={{ x: -100, opacity: 0 }}
              transition={{ duration: 0.8 }}
            >
              {projects.user.email}
            </motion.p>
          </div>
          <motion.div
            animate={{ x: 0, opacity: 1 }}
            initial={{ x: 100, opacity: 0 }}
            transition={{ duration: 0.8 }}
            // initial={{ opacity: 0, scale: 0 }}
            // animate={{ opacity: 1, scale: 1 }}
            // transition={{
            //   duration: 1.0,
            //   scale: { type: "spring", visualDuration: 0.4, bounce: 0.5 },
            // }}
          >
            <Link href={`https://wa.me/${projects.user.no_whatsapp}`}>
              <Button label={"Hubungi Via Whatsapp"}></Button>
            </Link>
          </motion.div>
        </div>
        {/* </div> */}
        <motion.div
          animate={{ y: 0, opacity: 1 }}
          initial={{ y: 100, opacity: 0 }}
          transition={{ duration: 0.8 }}
        >
          {" "}
          <DynamicImage
            width={1500}
            height={1000}
            src={projects.image_url}
            alt={projects.nama_project}
            className=""
          />
        </motion.div>
      </div>

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
