import Head from "next/head";
import { FeatureSection } from "@/components/sections/FeatureSection";
import {
  Header,
  HeroSection,
  TestimonialSection,
  FaqSection,
  Footer,
  PricingSection,
  LargeFeatureSection,
  CtaSection,
} from "../components/sections";

import {
  header,
  faqs,
  testimonials,
  features,
  pricing,
  clients,
  footer,
} from "@/data";

import axios from "axios";
import { useEffect, useState } from "react";
import Link from "next/link";
import dynamic from "next/dynamic";
import { motion } from "motion/react";
import { useRouter } from "next/router";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faEye } from "@fortawesome/free-regular-svg-icons";

export default function Home() {
  const router = useRouter();
  const [projects, setProjects] = useState([]);
  const DynamicImage = dynamic(() => import("../components/DynamicImage"), {
    ssr: false,
  });
  const getProjects = async () => {
    const url = "http://localhost:8000/api/projects/";
    axios.get(url).then((res) => {
      setProjects(res.data.data);
    });
  };

  const truncate = (text, maxLength) => {
    return text.length > maxLength
      ? text.substring(0, maxLength) + "..."
      : text;
  };

  // const filterProjects = projects.filter(
  //   (project) =>
  //     project.nama_project.toLowerCase().includes(search.toLowerCase()) ||
  //     project.user.nama.toLowerCase().includes(search.toLowerCase())
  // );

  useEffect(() => {
    getProjects();
  }, []);

  return (
    <>
      <Head>
        <title>Modef</title>
      </Head>
      <Header
        logo={header.logo}
        links={header.links}
        buttons={header.buttons}
      />
      <HeroSection
        id="home"
        badge={{
          // href: "#",
          icon: "tabler:arrow-right",
          label: "Mode Fashion",
        }}
        title="Modef"
        description="Koleksi desain busana penuh estetika dan inovasi dari siswa SMKN 8 Surabaya. Modef menghadirkan rangkaian portfolio yang menampilkan kreativitas, dan gaya yang siap bersaing di industri fashion."
        buttons={
          [
            // {
            //   href: "#",
            //   label: "Lihat Semua Portfolio",
            //   color: "dark",
            // },
            // {
            //   href: "#",
            //   label: "Learn More",
            //   color: "transparent",
            //   variant: "link",
            //   icon: "tabler:arrow-right",
            // },
          ]
        }
        // image={{
        //   src: "./tablet-mockup.png",
        //   alt: "Product Screenshot on Tablet",
        //   className: "w-full h-auto",
        // }}
        // clientsLabel="Trusted by 100+ Brands"
        // clients={clients}
      />

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
            <div className="flex justify-between mt-4 ">
              <div className="text-sm font-semibold">{item.user.nama}</div>
              <FontAwesomeIcon icon={faEye} />
            </div>
          </motion.div>
        ))}
      </div>

      {/* <FeatureSection
        id="features"
        title="Discover Our Amazing Features"
        description="Explore the wide range of powerful features that our product offers. From advanced analytics to seamless integrations, we have everything you need to succeed."
        features={features}
      />
      <LargeFeatureSection
        title="Stay on top of your business"
        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis similique"
        list={features.slice(0, 3)}
        image={{
          src: "./phone-mockup.png",
          alt: "Image",
          className:
            "w-full aspect-square object-contain rotate-6 hover:rotate-0 duration-300 ease-in-out",
        }}
      />
      <LargeFeatureSection
        reverse={true}
        title="Stay on top of your business"
        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis similique"
        list={features.slice(0, 3)}
        image={{
          src: "./phone-mockup.png",
          alt: "Image",
          className:
            "w-full aspect-square object-contain -rotate-6 hover:rotate-0 duration-300 ease-in-out",
        }}
      />
      <PricingSection
        id="pricing"
        title="Pricing for Everyone"
        description="Choose a plan that works for you. All plans include a 7-day free trial."
        badge={{
          leading: true,
          icon: "tabler:credit-card",
          label: "Plans",
        }}
        pricing={pricing}
      />
      <TestimonialSection
        id="testimonials"
        title="Love from our customers"
        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis similique
        veritatis"
        badge={{
          leading: true,
          icon: "tabler:heart",
          label: "TESTIMONIALS",
        }}
        testimonials={testimonials}
        button={{
          icon: "tabler:brand-x",
          label: "Share Your Feedback on",
          href: "#",
          color: "white",
        }}
      />
      <FaqSection
        id="faqs"
        title="Frequently Asked Questions"
        description="Here are some of our most frequently asked questions. If you have a question that isn't answered here, please feel free to contact us."
        buttons={[
          {
            label: "Contact Support",
            href: "#",
            color: "primary",
            variant: "link",
            icon: "tabler:arrow-right",
          },
        ]}
        faqs={faqs}
      /> */}
      {/* <CtaSection
        title="Ready to get started?"
        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis similique"
        buttons={[{ label: "Start for Free", href: "#", color: "dark" }]}
      /> */}
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
