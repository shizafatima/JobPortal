import { NavigationMenu, NavigationMenuItem, NavigationMenuLink, NavigationMenuList } from "@/components/ui/navigation-menu"
import { Tooltip, TooltipContent, TooltipTrigger } from "@/components/ui/tooltip"
import { useIsMobile } from "@/hooks/use-mobile"
import { Link, usePage } from "@inertiajs/react"
import { Bookmark, BriefcaseBusiness } from "lucide-react"

export default function AboutUs(){

    const isMobile = useIsMobile()
        const { url } = usePage()

    
        const links = [
            { href: "/jobSeeker/index", label: "Home" },
            { href: "/jobSeeker/aboutUs", label: "About Us" },
            { href: "/jobSeeker/appliedJobs", label: "Applied Jobs" },
            { href: "/jobSeeker/contactUs", label: "Contact Us" },
        ]
    return(
        <div>
            <header className="flex items-center justify-between w-full px-6 py-4">
                <div className="flex flex-wrap items-center font-bold text-2xl">
                    <BriefcaseBusiness className="mr-2"/>
                    <h3 className="text-[#309689]"> Job Portal</h3>
                </div>

                <div>
                    <NavigationMenu viewport={isMobile}>

                        <NavigationMenuList className="flex-wrap">
                            {links.map((link) => (

                                <NavigationMenuItem key ={link.href}>
                                    <NavigationMenuLink asChild>
                                        <Link 
                                        href={link.href}
                                        className={`px-3 py-1 rounded ${
                                                url === link.href
                                                    ? "bg-[#309689] text-white" // active link style
                                                    : "hover:bg-gray-200"
                                            }`}
                                        >
                                            {link.label}
                                        </Link>
                                    </NavigationMenuLink>
                                </NavigationMenuItem>

                            ))}

                        </NavigationMenuList>

                    </NavigationMenu>

                </div>


                <div>
                    <Tooltip>
                        <TooltipTrigger asChild>
                            <Bookmark />
                        </TooltipTrigger>
                        <TooltipContent>
                            <p>Saved Jobs</p>
                        </TooltipContent>
                    </Tooltip>

                </div>




            </header>
        </div>
    )
}