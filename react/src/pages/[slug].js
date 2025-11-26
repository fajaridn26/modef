import Head from "next/head";
import { Header, Footer } from "../components/sections";

import { header, footer } from "../data";

import axios from "axios";
import { useEffect, useState } from "react";
import { useRouter } from "next/router";
import { Button } from "@/components/base";
import Link from "next/link";
import dynamic from "next/dynamic";
import { ThreeDots } from "react-loader-spinner";

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
      <div className="flex justify-center items-center min-h-screen">
        <ThreeDots
          visible={true}
          height="80"
          width="80"
          color="#083b94ff"
          radius="9"
          ariaLabel="three-dots-loading"
        />
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

      <div className="container mx-auto py-24">
        {/* <div className="fixed container bg-base-50 z-10"> */}
        <div className="font-semibold text-2xl text-gray-800 mb-6">
          {projects.nama_project}
        </div>
        <div className="flex justify-between items-center mb-8">
          <div>
            <div className="font-semibold text-gray-800 text-md">
              {projects.user.nama}
            </div>
            <p className="text-sm text-light mt-2">{projects.user.email}</p>
          </div>
          <Link href={`https://wa.me/${projects.user.no_whatsapp}`}>
            <Button label={"Hubungi Via Whatsapp"}></Button>
          </Link>
        </div>
        {/* </div> */}
        <DynamicImage
          width={1500}
          height={1000}
          src={projects.image_url}
          alt={projects.nama_project}
          className=""
        />
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
