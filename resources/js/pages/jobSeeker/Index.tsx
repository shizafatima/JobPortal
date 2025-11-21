import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"
import { DropdownMenu, DropdownMenuContent, DropdownMenuGroup, DropdownMenuItem, DropdownMenuLabel, DropdownMenuTrigger } from "@/components/ui/dropdown-menu"
import { NavigationMenu, NavigationMenuItem, NavigationMenuLink, NavigationMenuList } from "@/components/ui/navigation-menu"
import { Tooltip, TooltipContent, TooltipTrigger } from "@/components/ui/tooltip"
import { useIsMobile } from "@/hooks/use-mobile"
import { login, logout, register } from "@/routes"
import { SharedData } from "@/types"
import { Link, router, usePage } from "@inertiajs/react"
import { Bell, Bookmark, BriefcaseBusiness, CircleUser, LogOut, Search } from "lucide-react"
import { useMobileNavigation } from '@/hooks/use-mobile-navigation'
import { useState } from "react"
import { Input } from "@/components/ui/input"
import { Button } from "@/components/ui/button"


export default function Index({
    canRegister = true,
}: {
    canRegister?: boolean;
}) {
    const isMobile = useIsMobile()
    const { url } = usePage()

    const links = [
        { href: "/jobSeeker/index", label: "Home" },
        { href: "/jobSeeker/aboutUs", label: "About Us" },
        { href: "/jobSeeker/appliedJobs", label: "Applied Jobs" },
        { href: "/jobSeeker/contactUs", label: "Contact Us" },
    ]
    const { auth } = usePage<SharedData>().props;

    const cleanup = useMobileNavigation();
    const handleLogout = () => {
        cleanup();
        router.flushAll();
    };

    const [hasUnread, setHasUnread] = useState(true);
    return (
        <div>
            <header className="flex items-center justify-between w-full px-6 py-4">
                <div className="flex flex-wrap items-center font-bold text-2xl">
                    <BriefcaseBusiness className="mr-2" />
                    <h3 className="text-[#309689]"> Job Portal</h3>
                </div>

                <div>
                    <NavigationMenu viewport={isMobile}>

                        <NavigationMenuList className="flex-wrap">
                            {links.map((link) => (

                                <NavigationMenuItem key={link.href}>
                                    <NavigationMenuLink asChild>
                                        <Link
                                            href={link.href}
                                            className={`px-3 py-1 rounded ${url === link.href
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


                <div className="flex items-center gap-4 align-baseline">
                    <Tooltip>
                        <TooltipTrigger asChild>
                            <Link
                                href="/jobSeeker/savedJobs"
                                className="p-2 rounded transition">
                                {url === "/jobSeeker/savedJobs" ? (
                                    <Bookmark className="h-6 w-6 text-[#309689]" fill="currentColor" />
                                ) : (
                                    <Bookmark className="h-6 w-6 text-gray-600" />
                                )}
                            </Link>

                        </TooltipTrigger>
                        <TooltipContent>
                            <p>Saved Jobs</p>
                        </TooltipContent>
                    </Tooltip>

                    <DropdownMenu>

                        <Tooltip>
                            <TooltipTrigger asChild>
                                <DropdownMenuTrigger asChild>

                                    <button className="p-2 rounded transition"
                                        onClick={() => setHasUnread(false)}>
                                        <Bell
                                            className={`h-6 w-6 ${hasUnread ? "text-[#309689]" : "text-gray-600"
                                                }`}
                                        />
                                    </button>

                                </DropdownMenuTrigger>
                            </TooltipTrigger>

                            <TooltipContent>
                                <p>Notifications</p>
                            </TooltipContent>
                        </Tooltip>


                        <DropdownMenuContent className="w-64 mr-3" align="end">
                            <DropdownMenuLabel>Notifications</DropdownMenuLabel>
                            <DropdownMenuGroup>
                                <DropdownMenuItem>
                                    You have 3 new job recommendations
                                </DropdownMenuItem>
                                <DropdownMenuItem>
                                    Your application for XYZ Company has been viewed
                                </DropdownMenuItem>
                                <DropdownMenuItem>
                                    New message from ABC Recruiter
                                </DropdownMenuItem>
                                <DropdownMenuItem>
                                    New notification
                                </DropdownMenuItem>
                            </DropdownMenuGroup>
                        </DropdownMenuContent>

                    </DropdownMenu>
                    {auth.user ? (
                        <DropdownMenu>
                            <DropdownMenuTrigger asChild>
                                <Avatar>
                                    <AvatarImage
                                        src="/avatar.jpg"
                                        alt="avatar image" />
                                    <AvatarFallback>IMG</AvatarFallback>
                                </Avatar>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent className="w-56 mr-3" align="start">
                                <DropdownMenuLabel>My Account</DropdownMenuLabel>
                                <DropdownMenuGroup>
                                    <DropdownMenuItem>
                                        <Link
                                            className="flex items-center w-full"
                                            href={logout()}
                                            as="button"
                                            onClick={handleLogout}
                                            data-test="logout-button"
                                        >
                                            <LogOut className="mr-2 h-4 w-4" />
                                            Log out
                                        </Link>
                                    </DropdownMenuItem>
                                </DropdownMenuGroup>

                            </DropdownMenuContent>
                        </DropdownMenu>

                    ) : (
                        <>
                            <Link
                                href={login()}
                                className="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                            >
                                Log in
                            </Link>
                            {canRegister && (
                                <Link
                                    href={register()}
                                    className="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                                >
                                    Register
                                </Link>
                            )}
                        </>
                    )}

                </div>




            </header >

            <div className="h-full flex justify-center flex-col">
                <h1 className="flex text-4xl font-bold justify-center items-center mt-20">Find Your Dream Job Here</h1>
                <p className="flex text-md justify-center items-center mt-5 text-gray-400">Connecting talent with Opportunity:Your Gateway to Success</p>
                <div className="flex justify-center mt-5">
                    <div className="relative w-[50%] mb-5">
                        <Input className="w-full h-15 pr-20 rounded-full px-6"
                        placeholder="Search here..."
                        />
                        <Button
                            // onClick={handleSearch}
                            className="absolute right-0 top-0 h-full bg-teal-500 hover:bg-teal-600 text-white px-6 py-3 rounded-full flex items-center gap-2 transition-colors ml-2"
                        >
                            <Search size={18} />
                            <span className="font-medium">Search Job</span>
                        </Button>
                    </div>


                </div>
            </div>


        </div >
    )
}